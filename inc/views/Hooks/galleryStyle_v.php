<?php
/**
 * CSS below is for fallback supported of `[gallery]` shortcode.
 * 
 * @package rundizstrap
 * @since 0.0.1
 */
?>
<style type="text/css" media="all">
    .gallery {
        align-content: center;
        column-gap: 12px;
        display: grid;
        justify-content: center;
        justify-items: center;
        row-gap: 15px;
    }

    .gallery-item {
        margin: 0;
        text-align: center;
    }

    .gallery-item .gallery-icon {
        aspect-ratio: 1/1;
        margin-left: auto;
        margin-right: auto;
        width: fit-content;
    }
    
    .gallery-item a {
        display: block;
    }

    .gallery img {
        height: auto;
        max-width: 100%;
    }

    .gallery-columns-2 {
        grid-template-columns: repeat(2, 1fr);
    }
    .gallery-columns-3 {
        grid-template-columns: repeat(3, 1fr);
    }
    .gallery-columns-4 {
        grid-template-columns: repeat(4, 1fr);
    }
    .gallery-columns-5 {
        grid-template-columns: repeat(5, 1fr);
    }
    .gallery-columns-6 {
        grid-template-columns: repeat(6, 1fr);
    }
    .gallery-columns-7 {
        grid-template-columns: repeat(7, 1fr);
    }
    .gallery-columns-8 {
        grid-template-columns: repeat(8, 1fr);
    }
    .gallery-columns-9 {
        grid-template-columns: repeat(9, 1fr);
    }
    .gallery-columns-10 {
        grid-template-columns: repeat(10, 1fr);
    }

    .gallery-caption {
        color: rgba(51, 51, 51, 0.7);
        display: block;
        font-family: "Noto Sans", sans-serif;
        font-size: .9rem;
        line-height: 1.5;
        margin-top: 5px;
        padding: 0;
        word-break: break-all;
        word-wrap: break-word;
    }

    .gallery-columns-4 .gallery-caption,
    .gallery-columns-5 .gallery-caption {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }
    .gallery-columns-6 .gallery-caption,
    .gallery-columns-7 .gallery-caption,
    .gallery-columns-8 .gallery-caption,
    .gallery-columns-9 .gallery-caption {
        display: none;
    }
</style>