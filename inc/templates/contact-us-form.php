<form>
    <div class="form-field">
        <label for="name">Name *</label>
        <input required autocomplete="off" type="text" id="name" class="input-field">
    </div>

    <div class="form-field">
        <label for="email">E-mail *</label>
        <input required autocomplete="off" type="email" id="email" class="input-field">
    </div>

    <div class="form-field">
        <label for="message">Message *</label>
        <textarea required autocomplete="off" type="text" id="message" class="input-field" rows="5"></textarea>
    </div>

    <div class="form-field submit">
        <button class="btn"><?php _e('Send Message'); ?></button>
    </div>
</form>