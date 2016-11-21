<?php namespace danmurf;

interface MetaTaggableInterface
{
    /**
     * Output the final set of meta tags.
     * @method render
     * @param  integer $indent_spaces The number of spaces to indent/prefix the tags by (defaut is 0).
     * @return string                 The meta tags.
     */
    public function render($indent_spaces = 0);

    /**
     * Set the noindex meta tag.
     * @method noindex
     * @param  boolean $value
     * @return null
     */
    public function noindex($value);

    /**
     * Output the noindex meta tag, if it was set.
     * @method render_noindex
     * @return string         The noindex meta tag.
     */
    public function render_noindex();

    /**
     * Set the page keywords.
     * @method keywords
     * @param  array    $keywords An array of keywords.
     * @return null
     */
    public function keywords($keywords);

    /**
     * Output the page keywords meta tag, if they were set.
     * @method render_keywords
     * @return string
     */
    public function render_keywords();

    /**
     * Set the page description.
     * @method description
     * @param  string      $description The page description.
     * @return null
     */
    public function description($description);

    /**
     * Output the page description meta tag, if it was set.
     * @method render_description
     * @return string
     */
    public function render_description();

    /**
     * Set the page author.
     * @method author
     * @param  string $author The page author.
     * @return null
     */
    public function author($author);

    /**
     * Output the page author meta tag, if it was set.
     * @method render_author
     * @return string
     */
    public function render_author();

    /**
     * Set the page's canonical URL.
     * @method canonical
     * @param  string    $url The page's canonical url
     * @return null
     */
    public function canonical($url);

    /**
     * Output the page's canonical URL link tag.
     * @method render_canonical
     * @return string           Link tag with the page's canonical URL.
     */
    public function render_canonical();
}
