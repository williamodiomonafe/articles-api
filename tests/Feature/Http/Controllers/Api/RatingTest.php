<?php

class RatingTest extends TestCase
{
    /**
     * @test
     *
     * Rate an article
     * @method POST
     * @endpoint /articles/{id}/rating
     */
    public function canRateAnArticle() {
        $response = $this->post('/articles/1/rating', [
            'user_id' => 2,
            'rating' => 4.0,
        ]);

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
           'article_id',
           'user_id',
           'rating'
        ]);
    }
}