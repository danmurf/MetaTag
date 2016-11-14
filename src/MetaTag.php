<?php

namespace danmurf\MetaTag;

/**
 * Meta tag library for accumulating and rendering HTML head meta tags.
 */
class MetaTag
{
    protected $prefix;
    protected $noindex;
    protected $keywords;
    protected $description;
    protected $author;
    protected $twitter_card;
    protected $open_graph;

    /**
     * Output the meta tags.
     * @method render
     * @return string All the completed meta tags for the head section.
     */
    public function render($indent_spaces = 0)
    {
        $this->prefix = str_repeat(" ", $indent_spaces);

        $output = "";
        $output .=  $this->render_noindex();
        $output .=  $this->render_keywords();
        $output .=  $this->render_description();
        $output .=  $this->render_author();

        return $output;
    }

    /**
     * Render a meta tag.
     * @method render_meta_tag
     * @param  string          $name    The name of the meta tag
     * @param  string          $content The content of the meta tag
     * @return string                   The final meta tag codes
     */
    private function render_meta_tag($name, $content)
    {
        $content = $this->sanitise_content($content);
        return $this->prefix . "<meta name=\"$name\" content=\"$content\">\n";
    }

    /**
     * Clean the content so it is suitable for a meta tag content field.
     * @method sanitise_content
     * @param  string           $content Dirty string, with tags, quotes and what not.
     * @return string                    Clean string, which won't break tags and will look nice.
     */
    private function sanitise_content($content)
    {
        //Remove any tags
        $content = strip_tags($content);

        //Remove newlines from content
        $content = trim(preg_replace('/\s+/', ' ', $content));

        //Remove any double quotes
        $content = str_replace('"', '', $content);

        return $content;
    }

    /**
     * Whether to add a noindex tag to the page.
     * @method noindex
     * @param  boolean $value True if you would like the page not to be indexed.
     */
    public function noindex($value = false)
    {
        $this->noindex = $value;
    }

    /**
     * Render the noindex tag.
     * @method render_noindex
     * @return string         The final noindex tag string.
     */
    public function render_noindex()
    {
        return $this->noindex == true ? $this->render_meta_tag('robots', "noindex, noarchive, nofollow") : null;
    }

    /**
     * Set the page meta keywords.
     * @method keywords
     * @param  array    $keywords An array of keywords to include.
     */
    public function keywords($keywords = array())
    {
        $this->keywords = $keywords;
    }

    /**
     * Render the keywords tag.
     * @method render_keywords
     * @return string          The final keywords meta tag.
     */
    public function render_keywords()
    {
        return sizeof($this->keywords) > 0 ? $this->render_meta_tag('keywords', implode (", ", $this->keywords)) : null;
    }

    /**
     * Set the page meta description.
     * @method description
     * @param  string      $description A description of the page.
     */
    public function description($description = '')
    {
        $this->description = $description;
    }

    /**
     * Render the description meta tag.
     * @method render_description
     * @return string             The final description meta tag string.
     */
    public function render_description()
    {
        return strlen($this->description) > 0 ? $this->render_meta_tag('description', $this->description) : null;
    }

    /**
     * Set the page's author meta tag.
     * @method author
     * @param  string $author The name of the author.
     */
    public function author($author = '')
    {
        $this->author = $author;
    }

    /**
     * Render the author meta tag.
     * @method render_author
     * @return string        The final author meta tag.
     */
    public function render_author()
    {
        return strlen($this->author) > 0 ? $this->render_meta_tag('author', $this->author) : null;
    }
}
