<script>
    var cartCount = $('#cartCount').val();
    if(cartCount == 0) {
        $('.badge').hide();
    } else {
        $('.badge').text(cartCount);
    }
</script>