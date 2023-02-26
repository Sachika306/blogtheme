<?php
/**-------------------------------------
 * 必須情報設定
 * 注意：このファイルの名前を変えたら、wp-cli.ymlの設定も変える必要がある
 --------------------------------------*/
class createRanking extends WP_CLI_Command {
	function createRankingByWeeklyPageView() {
		// APIを叩くのに必要な設定が入ってるか確認
		if (
			!get_theme_mod('gpc_service_account_name') ||
			!file_exists(dirname(__DIR__, 1)  . '/keys/' . get_theme_mod('gpc_service_account_key')) ||
			!get_theme_mod('google_analytics_id') 
		) {
			throw new Error('APIの実行に必要情報がサイドバーから登録されていないか、キーが見つかりませんでした');
		}
		
		try {
			define('SERVICE_ACOUNT_NAME', get_theme_mod('gpc_service_account_name')); // サービスアカウント名（メールアドレス）, GCPで確認できる。
			define('KEY_FILE_LOCATION', dirname(__DIR__, 1)  . '/keys/' . get_theme_mod('gpc_service_account_key')); // キーファイルのパス TODO:外部から呼び出し
			define('ANALYTICS_VIEW_ID','ga:' . get_theme_mod('google_analytics_id')); // アナリティクスのビューID 例)'ga:1234567' TODO
			define('MAX_GET_COUNT', 10); // APIで取得したい件数、固定で10件取得。
			define('START_DATE', date("Y-m-d", strtotime("-1 week"))); // APIで取得したい日の対象A（A日～）
			define('END_DATE', date("Y-m-d", strtotime("-1 day"))); // APIで取得したい日の対象B（～B日まで）

			// APIで取得する条件
			$target_array = array(
				'dimensions'  => 'ga:pagePath', // 取得するディメンション
				'sort'        => '-ga:pageviews', // ページビューを取得
				'max-results' => MAX_GET_COUNT, //件数
				'filters' => 'ga:pagePath=~/?p=;ga:pagePath!@wp-admin' // フィルタリングが必要な場合はこちらに、例えば特定ディレクトリ直下なら（~/FujisakiShiori/）など記述
			);

			// PHP用ライブラリ
			$phpLibrary = dirname(__DIR__, 1) . '/include/vendor/autoload.php';
			require_once $phpLibrary;

			/**
			 * Analytics Apifunction Client生成
			 */
			$client = new Google_Client();

			// トークンのセット
			if (isset($_SESSION['service_token'])) {
				$client->setAccessToken($_SESSION['service_token']);
			}

			// クレデンシャルの作成
			$client->setAuthConfig(KEY_FILE_LOCATION);
			$client->useApplicationDefaultCredentials();
			$client->addScope('https://www.googleapis.com/auth/analytics');

			// セッションの設定
			$_SESSION['service_token'] = $client->getAccessToken();

			// アナリティクスクライアントを生成
			$analytics = new Google_Service_Analytics($client);

			//指定期間のPVランキング取得
			$result = $analytics->data_ga->get(
				ANALYTICS_VIEW_ID,
				START_DATE, //開始日
				END_DATE, //終了日
				'ga:pageviews',
				$target_array
			);

			print_r($result['rows']);
		
			$fileOutputPath = get_theme_file_path("/batchOutput/ranking-result.php");
			$fileOutputResult = file_put_contents($fileOutputPath, json_encode($result['rows']));
			
			if (!$fileOutputResult) {
				throw new Error('ランキング取得結果のファイルへの書き込みがうまくいきませんでした');
			}
			
		} catch (Exception $e) {
			echo '例外：',  $e->getMessage(), "\n";
		}
	}
}

WP_CLI::add_command('create-ranking', 'createRanking');
?>