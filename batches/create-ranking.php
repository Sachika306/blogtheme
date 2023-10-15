<?php
/**-------------------------------------
 * 必須情報設定
 * 注意：このファイルの名前を変えたら、wp-cli.ymlの設定も変える必要がある
 --------------------------------------*/
 require dirname(__DIR__, 1) . '/include/vendor/autoload.php';
 use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
 use Google\Analytics\Data\V1beta\DateRange;
 use Google\Analytics\Data\V1beta\Dimension;
 use Google\Analytics\Data\V1beta\Metric;
 use Google\Analytics\Data\V1beta\OrderBy;

class createRanking extends WP_CLI_Command {

	function createRankingByWeeklyPageView() {

		try {
			putenv('GOOGLE_APPLICATION_CREDENTIALS='  . dirname(__DIR__, 1)  . '/keys/' . get_theme_mod('gpc_service_account_key'));
			echo 'GOOGLE_APPLICATION_CREDENTIALS='  . dirname(__DIR__, 1)  . '/keys/' . get_theme_mod('gpc_service_account_key');
			define('MAX_GET_COUNT', 10); // APIで取得したい件数、固定で10件取得。

			$client = new BetaAnalyticsDataClient();

			$response = $client->runReport([
				'property' => 'properties/' . get_theme_mod('google_analytics_id'),
				'dateRanges' => [
					new DateRange([
						'start_date' => '8daysAgo',
						'end_date' => '1daysAgo',
					]),
				],
			
				'dimensions' => [
					new Dimension(
						[
							'name' => 'pagepath',
						]
					),
				],
			
				'metrics' => [
					new Metric(
						[
							'name' => 'sessions',
						]
					),
				],

				'limit' => MAX_GET_COUNT,

			]);

			$result = array();
			foreach ($response->getRows() as $row) {
				$dimensionValues = array();
				foreach($row->getDimensionValues() as $v) {
					$dimensionValues[] = $v->getValue();
				}
			
				$metricValues = array();
				foreach ($row->getMetricValues() as $v) {
					$metricValues[] = $v->getValue();
				}
			
				// パスのスラッシュ取る
				$dimensionValue = str_replace("/", "", $dimensionValues[0]);

				// ホーム画面の結果は不要
				if (empty($dimensionValue)) {
				} else {
					$result[] = array($dimensionValue, $metricValues[0]);
				}
			}
			
			if (!isset($result)) {
				throw new Error('ランキング取得結果のファイルへの書き込みがうまくいきませんでした');
			}

			var_dump($result);

			$fileOutputPath = get_theme_file_path("/batchOutput/ranking-result.php");
			$fileOutputResult = file_put_contents($fileOutputPath, json_encode($result));
			
			if (!$fileOutputResult) {
				throw new Error('ランキング取得結果のファイルへの書き込みがうまくいきませんでした');
			}
			
		} catch (Exception $e) {
			echo $e->getMessage(), "\n";
		};
	}
}
WP_CLI::add_command('create-ranking', 'createRanking');
?>