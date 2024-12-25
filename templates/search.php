<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60)">
    <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
        <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|50"},"padding":{"top":"0","bottom":"0"}}}} -->
        <div class="wp-block-columns alignwide" style="padding-top:0;padding-bottom:0">
            <!-- wp:column {"width":"200px","className":"is-style-default","style":{"spacing":{"padding":{"top":"var:preset|spacing|70"},"blockGap":"0"}}} -->
            <div class="wp-block-column is-style-default" style="padding-top:var(--wp--preset--spacing--70);flex-basis:200px">
                <!-- wp:heading -->
                <h2 class="wp-block-heading">Filter</h2>
                <!-- /wp:heading -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70"},"blockGap":"0"}}} -->
            <div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--70)">
                <!-- wp:heading -->
                <h2 class="wp-block-heading">Resultaten</h2>
                <!-- /wp:heading -->

                <!-- wp:query {"queryId":15,"query":{"perPage":10,"pages":0,"offset":0,"postType":"room","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"metadata":{"patternName":"core/query-standard-posts","name":"Standaard"}} -->
                <div class="wp-block-query">
                    <!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
                    <!-- wp:post-title {"level": 4,"isLink":true} /-->

                    <!-- wp:post-featured-image {"isLink":true,"align":"wide"} /-->

                    <!-- wp:post-excerpt /-->

                    <!-- wp:separator {"opacity":"css"} -->
                    <hr class="wp-block-separator has-css-opacity"/>
                    <!-- /wp:separator -->

                    <!-- /wp:post-template -->
                </div>
                <!-- /wp:query -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->