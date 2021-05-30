<?php
declare(strict_types=1);

namespace console\controllers;

use common\models\GitUser;
use common\models\GitUsersRepo;
use yii\console\Controller;
use yii\httpclient\Client;

class GitUsersRepoController extends Controller
{
    /**
     * @throws \yii\httpclient\Exception
     * @throws \yii\db\Exception
     * @throws \Throwable
     */
    public function actionIndex(): void
    {
        $gitHubApiUrl = 'https://api.github.com/users/';
        $users = GitUser::find()->select('username')->all();

        $client = new Client(['baseUrl' => $gitHubApiUrl]);
        $params = [
            'sort' => 'updated',
            'per_page' => 10,
        ];
        // User-agent http header is required by Github API
        // REF : http://developer.github.com/v3/#user-agent-required
        $headers = ['User-Agent' => 'kekemeke'];
        $repos = [];

        echo "Start getting data from github\n";
        /** @var GitUser $user */
        foreach($users as $user) {
            $response = $client->get($user->username . '/repos', $params, $headers)->send();

            if (!$response->content) {
                echo 'Error with request send' . PHP_EOL . $user->username;
                die();
            }

            $data = json_decode($response->content, true);
            // when user not found(may be we have more bad messages, but for now i just check for this one)
            if (isset($data['message'])) {
                continue;
            }
            foreach ($data as $repo) {
                $repos[$repo['updated_at']] = [
                    'username' => $user->username,
                    'link' => $repo['html_url'],
                    'updated_at' => $repo['updated_at'],
                ];
            }
        }

        ksort($repos, SORT_STRING);
        $slicedRepos = array_slice($repos, 0, 10);

        echo "Update GitUsersRepo table\n";

        GitUsersRepo::deleteAll();
        $transaction = \Yii::$app->getDb()->beginTransaction();
        try {
            \Yii::$app->db->createCommand()->batchInsert(
                GitUsersRepo::tableName(),
                ['username', 'link', 'updated_at'],
                $slicedRepos
            )->execute();

            $transaction->commit();
        } catch (\Throwable $e) {
            $transaction->rollBack();
            echo "RollBack\n";
            throw $e;
        }

        echo "Git user repos updated, see you!\n";
        die();
    }
}