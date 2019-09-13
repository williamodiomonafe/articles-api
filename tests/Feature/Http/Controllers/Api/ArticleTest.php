<?php
/**
 * Created by Oshoname William Odiomonafe.
 * User: Oshoname William Odiomonafe
 * Date: 9/11/2019
 * Time: 12:52 PM
 */

use App\Article;
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
        // GIVEN
            // authentication passed


        // WHEN
        $response = $this->post('/articles', [
            'user_id' => 1,
            'title' => 'Hello World',
            'body' => 'Hello, you are welcome to my first ever published post on this test. Thank You',
            'published' => 1,
        ]);

        // THEN
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
    public function canGetAnArticle()
    {
        // GIVEN

        // WHEN
        $response = $this->get('/articles/1');

        // THEN
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'user_id',
            'title',
            'body',
            'published'
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
        // GIVEN

        // WHEN
        $response = $this->get('/articles');

        // THEN
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'data' => [
                '*' => [
                    'user_id',
                    'title',
                    'body',
                    'published'
                ]
            ],
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
        // GIVEN

        // WHEN
        $response = $this->put('/articles/1', [
            'user_id' => 1,
            'title' => 'Hello My Favourite World',
            'body' => 'I just updated the Hello World Article and unpublished it',
            'published' => 0,
        ]);

        // THEN
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
        // GIVEN


        // WHEN
        $response = $this->delete('/articles/1');

        // THEN
        $response->assertResponseStatus(410);
    }


    public function canSearchForAnArticle()
    {
        // GIVEN

        // WHEN
        $response = $this->get('/articles/search', [
            'title' => 'Hello',
        ]);


        // THEN
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'user_id',
            'title',
            'body',
            'published',
            'created_at',
        ]);
    }

}