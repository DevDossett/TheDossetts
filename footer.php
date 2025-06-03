                </main>
                <?php get_sidebar(); ?>
            </div>
            <footer id="footer" role="contentinfo">
                <?php 
                    global $TD__hideCopyright;
                    if(isset($TD__hideCopyright) && $TD__hideCopyright){
                        
                    } else {
                        ?>
                <div id="copyright">
                &copy; <?php echo esc_html( date_i18n( __( 'Y', 'TD_' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                </div>
                        <?php
                    }
                ?>
            
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>