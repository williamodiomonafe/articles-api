<?php
/**
 * Created by Oshoname William Odiomonafe.
 * User: Oshoname William Odiomonafe
 * Date: 9/11/2019
 * Time: 12:52 PM
 */

use Faker\Factory;

class ArticleTest extends TestCase
{

    /**
     * @test
     * Authenticated User Create an article via POST
     * @endpoint /articles
     * @method POST
     */
    public function canCreateAnArticle()
    {
        $factory = Factory::create();
        $response = $this->post('/articles', [
            'user_id' => random_int(1,5),
            'title' => $factory->sentence,
            'body' => $factory->paragraph,
            'published' => random_int(0,1),
        ]);

        $response->assertResponseStatus(201);
    }


    /**
     * @test
     *
     * Get a an Article by id
     * @endpoint /articles/{id}
     * @method GET
     *
     */
    public function canGetAnArticleAndSeeRating()
    {
        $response = $this->get('/articles/1');

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'user_id',
            'title',
            'body',
            'published',
            'ratings',
        ]);
    }


    /**
     * @test
     *
     * Get all articles
     * @endpoint /articles
     * @method GET
     */
    public function canGetAllArticles()
    {
        $response = $this->get('/articles');
        $response->assertResponseStatus(200);
    }

    /**
     * @test
     *
     * Anyone can search for an article
     * @method POST
     * @endpoint /articles/search
     */
    public function canSearchForAnArticle()
    {
        $response = $this->post('/articles/search', [
            'do_query' => 'a',
        ]);


        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            [
                'user_id',
                'title',
                'body',
                'published',
                'created_at',
            ]
        ]);
    }


    /**
     * @test
     *
     * Authorized User can update an article
     * @method PUT
     * endpoint /article/{id}
     */
    public function canUpdateAnArticle()
    {
        $response = $this->put('/articles/1', [
            'user_id' => 1,
            'title' => 'An update to my first article',
            'body' => 'This is an update the the first article. Please read through',
            'published' => 0,
        ]);

        $response->assertResponseStatus(200);
    }


    /**
     * @test
     *
     * Authorized User can delete an article
     * @method DELETE
     * @endpoint /articles/{id}
     */
    public function canDeleteAnArticle()
    {
        $response = $this->delete('/articles/1');
        $response->assertResponseStatus(410);
    }
}