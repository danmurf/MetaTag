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
      * @covers \danmurf\MetaTag::render_keywords
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
      * @covers \danmurf\MetaTag::noindex
      */
     public function can_set_no_index()
     {
         //Set the no index tag
         $metatag = new MetaTag();
         $this->assertNull($metatag->noindex(true));
     }

     /**
      * @test
      * @covers \danmurf\MetaTag::render_noindex
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
      * @covers \danmurf\MetaTag::description
      */
     public function can_set_description()
     {
         //Set the description tag
         $metatag = new MetaTag();
         $this->assertNull($metatag->description("This is a description of the webpage."));
     }

     /**
      * @test
      * @covers \danmurf\MetaTag::render_description
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
      * @covers \danmurf\MetaTag::author
      */
     public function can_set_author()
     {
         //Set the author tag
         $metatag = new MetaTag();
         $this->assertNull($metatag->author("Jessie Wongus"));
     }

     /**
      * @test
      * @covers \danmurf\MetaTag::render_author
      */
     public function can_render_author()
     {
         //Set the author tag
         $metatag = new MetaTag();
         $metatag->author("Jessie Wongus");

         //Check it renders correctly
         $expected_result = '<meta name="author" content="Jessie Wongus">'."\n";
         $this->assertEquals($expected_result, $metatag->render_author());
     }

     /**
      * @test
      * @covers \danmurf\MetaTag::sanitise_content
      */
     public function content_is_properly_sanitised()
     {
         //Set the author tag
         $metatag = new MetaTag();
         $metatag->description('Here is a string with "double quotes" <tags> and a new
         line');

         //Check it renders correctly
         $expected_result = '<meta name="description" content="Here is a string with double quotes and a new line">'."\n";
         $this->assertEquals($expected_result, $metatag->render_description());
     }

     /**
      * @test
      * @covers \danmurf\MetaTag::render
      * @covers \danmurf\MetaTag::render_meta_tag
      */
     public function all_tags_render_together()
     {
         //Set the tags
         $metatag = new MetaTag();
         $metatag->noindex(true);
         $metatag->keywords(['first', 'second', 'third']);
         $metatag->description("This is a description of the webpage.");
         $metatag->author("Jessie Wongus");

         //Build the expected results with 4 spaces indented
         $expected_result =  '    <meta name="robots" content="noindex, noarchive, nofollow">'."\n";
         $expected_result .= '    <meta name="keywords" content="first, second, third">'."\n";
         $expected_result .= '    <meta name="description" content="This is a description of the webpage.">'."\n";
         $expected_result .= '    <meta name="author" content="Jessie Wongus">'."\n";

         $this->assertEquals($expected_result, $metatag->render(4)); //Render the results with 4 spaces indented
     }
}
