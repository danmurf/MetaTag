<?php

use danmurf\MetaTag;

class MetaTagTest extends TestCase
{
    /**
     * @test
     * @covers \danmurf\MetaTag::keywords
     */
     public function can_set_keywords()
     {
         $metatag = new MetaTag();
         $this->assertNull($metatag->keywords(['first', 'second', 'third']));
     }

     /**
      * @test
      */
     public function can_render_keywords()
     {
         //Set the keywords
         $metatag = new MetaTag();
         $metatag->keywords(['first', 'second', 'third']);

         //Check they render correctly
         $expected_result = '<meta name="keywords" content="first, second, third">'."\n";
         $this->assertEquals($expected_result, $metatag->render_keywords());
     }

     /**
      * @test
      */
     public function can_set_no_index()
     {
         //Set the no index tag
         $metatag = new MetaTag();
         $this->assertNull($metatag->noindex(true));
     }

     /**
      * @test
      */
     public function can_render_no_index()
     {
         //Set the no index tag
         $metatag = new MetaTag();
         $metatag->noindex(true);

         //Check it renders correctly
         $expected_result = '<meta name="robots" content="noindex, noarchive, nofollow">'."\n";
         $this->assertEquals($expected_result, $metatag->render_noindex());
     }

     /**
      * @test
      */
     public function can_set_description()
     {
         //Set the description tag
         $metatag = new MetaTag();
         $this->assertNull($metatag->description("This is a description of the webpage."));
     }

     /**
      * @test
      */
     public function can_render_description()
     {
         //Set the description tag
         $metatag = new MetaTag();
         $metatag->description("This is a description of the webpage.");

         //Check it renders correctly
         $expected_result = '<meta name="description" content="This is a description of the webpage.">'."\n";
         $this->assertEquals($expected_result, $metatag->render_description());
     }

     /**
      * @test
      */
     public function can_set_author()
     {
         //@ToDo
     }

     /**
      * @test
      */
     public function can_render_author()
     {
         //@ToDo
     }
}
