<?php
/**
 * Class Mokime_Table_Of_Contents
 *
 * @@package mokime
 */

class Mokime_Table_Of_Contents {

	/**
	 *
	 * @var int $postid
	 */
	private $postid;

	/**
	 *
	 * @var array $toc
	 */
	private $toc = array();

	/**
	 *
	 * @var array $tocmap
	 */
	private $tocmap = array();

	/**
	 *
	 * @var null
	 */
	private $toccache = null;

	/**
	 *
	 *
	 * @var int $minlevel
	 */
	private $minlevel = 6;

	/**
	 * The total pages number.
	 *
	 * @var int $pagenum
	 */
	private $pagenum = 1;

	/**
	 * @param $level
	 * @param $tocid
	 * @param $text
	 */
	function add_toc( $level, $tocid, $text ) {
		$this->toc[]    = array( $this->pagenum, $level, $tocid, $text );
		$this->minlevel = min( $this->minlevel, $level );
	}

	/**
	 * @param $text
	 * @return string
	 */
	function get_tocid( $text ) {
		$search  = explode( ',', 'ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u' );
		$replace = explode( ',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u' );
		$chaine  = str_replace( $search, $replace, $text );
		$tocid   = sanitize_title_with_dashes( $chaine );
		$count   = 0;

		while ( isset( $this->tocmap[ $tocid ] ) ) {
			$tocid = $text . strval( ++ $count );
		}

		$this->tocmap[ $tocid ] = true;

		return "$tocid";
	}

	/**
	 * @return string
	 */
	function get_toc() {

		global $wp_rewrite;

		if ( isset( $this->toccache ) ) {
			return $this->toccache;
		}

		if ( ! isset( $this->toc ) ) {
			return '';
		}

		$html            = '';
		$permalink       = get_permalink( $this->postid );
		$toc_count       = count( $this->toc );
		$level_previous  = 10;
		$levels_to_close = 0;

		for ( $i = 0; $i < $toc_count; $i ++ ) {

			list($pagenum, $level, $tocid, $text) = $this->toc[ $i ];
			$link                                 = $permalink;
			if ( $pagenum > 1 ) {
				if ( $wp_rewrite->using_permalinks() ) {
					$link = trailingslashit( $link ) . "$pagenum/";
				} else {
					$link .= "&page=$pagenum";
				}
			}

			$link = sprintf(
				'<a href="%s" title="%s">%s</a>',
				"$link#$tocid",
				wp_strip_all_tags( $text ),
				$text
			);

			if ( 0 === $i ) {
				$level          = min( $level, $this->minlevel );
				$html          .= "<div class='toc'><ol id='toc_list'><li class='toc_$level'>$link";
				$level_previous = $level;
				continue;
			}

			if ( $level > $level_previous ) { // the previous title is higher h2 > h3.
				$html .= "\n<ol class='toc_sublist'><li class='toc_$level'>$link";
				$levels_to_close ++;
			} elseif ( $level_previous > $level ) { // the previous title is lower h4 > h2.
				for ( $l = 0; $l < $levels_to_close; $l++ ) {
					$html .= '</li></ol>';
				}
				$html           .= "</li>\n<li class='toc_$level'>$link";
				$levels_to_close = 0;
			} else { // the previous title is the same h2 = h2.
				$html .= "</li>\n<li class='toc_$level'>$link";
			}
			$level_previous = $level;
		}

		// close all opened li before closing the list.
		for ( $l = 0; $l < $levels_to_close; $l++ ) {
			$html .= '</li></ol>';
		}
		$html .= '</ol></div>';

		return $html;
	}

	/**
	 * @param $match
	 * @return mixed|string
	 */
	function replace_heading( $match ) {

		if ( $match[0] == '<!--nextpage-->' ) {
			$this->pagenum ++;
			return $match[0];
		}
		$tocid = $this->get_tocid( $match[3] );
		$this->add_toc( intval( $match[1] ), $tocid, $match[3] );
		return "<h$match[1] id=\"$tocid\"$match[2]>$match[3]</h$match[1]>";
	}

	/**
	 * @param $content
	 * @return string|string[]|null
	 */
	function the_content( $content ) {
		$this->toc      = array();
		$this->tocmap   = array();
		$this->toccache = null;
		$this->minlevel = 6;
		$this->pagenum  = 1;
		$regex          = '#<h([1-6])(.*?)>(.*?)</h\1>|<!--nextpage-->#';
		$content        = preg_replace_callback(
			$regex,
			array( &$this, 'replace_heading' ),
			$content
		);
		return preg_replace(
			'|(<p>)?<!--TOC-->(</p>)?|',
			$this->get_toc(),
			$content
		);
	}

	/**
	 * @param $posts
	 * @return mixed
	 */
	function the_posts( $posts ) {

		for ( $i = 0; $i < count( $posts ); $i ++ ) {
			$post               = &$posts[ $i ];
			$this->postid       = $post->ID;
			$post->post_content = $this->the_content( $post->post_content );
			$post->post_toc     = $this->get_toc();
		}

		return $posts;
	}
};

add_filter( 'the_posts', array( new Mokime_Table_Of_Contents(), 'the_posts' ) );
