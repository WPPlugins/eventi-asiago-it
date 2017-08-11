<?php
namespace WebCloud\AsiagoEvents;

// If locale is NULL or the empty string "", the locale names
// will be set from the values of environment variables with
// the same names as the above categories, or from "LANG".
setlocale(LC_TIME, NULL);

function format_date($start, $end) {
    $start = date_timestamp_get(date_create($start));
    $end = date_timestamp_get(date_create($end));

    // `%#d` funziona solo su Windows
    // http://php.net/manual/it/function.strftime.php#118581
    $result = strftime('%a %#d %B', $start);
    if ($start != $end) {
        $result .= strftime(' – %#d %B', $end);
    }

    return $result;
}

function format_time($start, $end) {
    $start = date_create($start);
    $result = date_format($start, 'G.i');

    return "Ore $result";
}
?>

<style>
    .webcloud-asiago-events,
    .webcloud-asiago-events * {
        box-sizing: border-box;
    }

    .webcloud-asiago-events-article:hover {
        background-image: radial-gradient(rgba(127, 127, 127, 0.3), transparent 80%);
    }

    .webcloud-asiago-events__list,
    .webcloud-asiago-events-article__content,
    .webcloud-asiago-events-article-datetime,
    .webcloud-asiago-events-article-categories {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .webcloud-asiago-events__link,
    .webcloud-asiago-events__link:hover,
    .webcloud-asiago-events__link:focus,
    .webcloud-asiago-events__link:active  {
        color: inherit;
        text-decoration: inherit;
    }

    .webcloud-asiago-events-article__content {
        margin: 0 -1rem;
    }

    .webcloud-asiago-events-article__images,
    .webcloud-asiago-events-article__text {
        display: inline-block;
        vertical-align: top;
        padding: 0 1rem;
    }

    .webcloud-asiago-events-article__images {
        width: 40%;
    }

    .webcloud-asiago-events-article__text {
        width: 60%;
    }

    .webcloud-asiago-events__item {
        margin-bottom: 3rem;
    }

    .webcloud-asiago-events-article__title {
        margin-bottom: .75rem;
    }

    .webcloud-asiago-events-article__figure {
        max-height: 13rem;
        overflow: hidden;
        margin: 0;
    }

    .webcloud-asiago-events-article__image {
        width: 100%;
        height: auto;
        display: block;
        max-width: none;
    }

    .webcloud-asiago-events-article-datetime {
        background-color: rgba(127,127,127,.15);
        margin-bottom: .75rem;
        padding: 0 .3rem;
    }

    .webcloud-asiago-events-article-datetime__date,
    .webcloud-asiago-events-article-datetime__time {
        display: inline-block;
        vertical-align: middle;
        width: 50%;
        white-space: nowrap;
        font-size: .8rem;
    }

    .webcloud-asiago-events-article-datetime__time {
        text-align: right;
    }

    .webcloud-asiago-events-more {
        text-align: center;
    }

    .webcloud-asiago-events-more__button {
        background-color: rgba(127,127,127,.15);
        border-radius: .3rem;
        padding: .75rem;
    }

    .webcloud-asiago-events-article-categories {
        text-align: right;
    }

    .webcloud-asiago-events-article-categories__item {
        border: 2px solid rgba(127,127,127,.15);
        border-radius: .3rem;
        display: inline-block;
        vertical-align: top;
        padding: .3rem .5rem;
        font-size: .8rem;
        color: rgba(127,127,127,1);
        text-transform: lowercase;
    }

    .webcloud-asiago-events-article__intro {
        margin-bottom: .75rem;
    }

    .webcloud-asiago-events__title {
        margin-bottom: 2rem;
    }
</style>

<div class="webcloud-asiago-events">
    <?php if(isset($args['title'])) :?>
    <h2 class="webcloud-asiago-events__title"><?= $args['title'] ?></h2>
    <?php endif ?>
    <ul class="webcloud-asiago-events__list">
        <?php foreach ($events as $key => $event) :?>
        <li class="webcloud-asiago-events__item">
            <a class="webcloud-asiago-events__link" href="<?= $event['url'] ?>" target="_blank">
                <article class="webcloud-asiago-events-article">
                    <ul class="webcloud-asiago-events-article__content">
                        <li class="webcloud-asiago-events-article__images">
                            <?php if(array_key_exists(0, $event['images'])) :?>
                            <figure class="webcloud-asiago-events-article__figure">
                                <img class="webcloud-asiago-events-article__image" src="<?= $event['images'][0]['url'] ?>" alt="<?= $event['title'] ?>">
                            </figure>
                            <?php endif ?>
                        </li><li class="webcloud-asiago-events-article__text">
                            <h3 class="webcloud-asiago-events-article__title"><?= $event['title'] ?></h3>
                            <ul class="webcloud-asiago-events-article-datetime">
                                <li class="webcloud-asiago-events-article-datetime__date"><?= format_date($event['date']['start'], $event['date']['end']) ?></li><?php if($event['time']['start'] != null) :?><li class="webcloud-asiago-events-article-datetime__time"><?= format_time($event['time']['start'], $event['time']['end']) ?></li>
                                <?php endif ?>
                            </ul>
                            <p class="webcloud-asiago-events-article__intro"><?= $event['intro'] ?>&hellip;</p>
                            <?php if(array_key_exists(0, $event['categories'])) :?>
                            <ul class="webcloud-asiago-events-article-categories">
                                <li class="webcloud-asiago-events-article-categories__item"><?= $event['categories'][0]['title'] ?></li>
                            </ul>
                            <?php endif ?>
                        </li>
                    </ul>
                </article>
            </a>
        </li>
        <?php endforeach ?>
    </ul>
    <div class="webcloud-asiago-events-more">
        <a class="webcloud-asiago-events-more__button" href="https://www.asiago.it/eventi" target="_blank">Scopri gli altri eventi dell'Altopiano su Asiago.it</a>
    </div>
</div>