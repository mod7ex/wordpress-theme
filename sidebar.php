<div id="sidebar" class="hidden">

    <button class="sidebar-toggler">&times;</button>


    <div>
        <?php if(is_user_logged_in()): ?>
        <form action="<?= esc_url( admin_url('admin-post.php') ) ?>" method="post">
            <input type="hidden" name="_logout_nonce" value="<?= wp_create_nonce('_logout_nonce_action') ?>">
            <input type="hidden" name="action" value="modexy_logout_action">
            <input type="submit" class="btn-link" name="logout" value="Logout">
        </form>
        <?php else: ?>
        <a href="/login">Login</a>
        <?php endif; ?>
    </div>

    <?php dynamic_sidebar('sidebar-1'); ?>

</div>

<div class="screen-overlay hidden">

    <span class="loading hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24">
            <path
                d="M13.75 22c0 .966-.783 1.75-1.75 1.75s-1.75-.784-1.75-1.75.783-1.75 1.75-1.75 1.75.784 1.75 1.75zm-1.75-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 10.75c.689 0 1.249.561 1.249 1.25 0 .69-.56 1.25-1.249 1.25-.69 0-1.249-.559-1.249-1.25 0-.689.559-1.25 1.249-1.25zm-22 1.25c0 1.105.896 2 2 2s2-.895 2-2c0-1.104-.896-2-2-2s-2 .896-2 2zm19-8c.551 0 1 .449 1 1 0 .553-.449 1.002-1 1-.551 0-1-.447-1-.998 0-.553.449-1.002 1-1.002zm0 13.5c.828 0 1.5.672 1.5 1.5s-.672 1.501-1.502 1.5c-.826 0-1.498-.671-1.498-1.499 0-.829.672-1.501 1.5-1.501zm-14-14.5c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm0 14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2z" />
        </svg>
    </span>

</div>