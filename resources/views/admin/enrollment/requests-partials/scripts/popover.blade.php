{{-- Popover --}}
<script>
    $(function () {
        $('[data-toggle="popover"]').popover({
            container: 'body'
        })
    })

    $('[data-toggle="popover"]').on('show.bs.popover', function(){
        $('div.popover').css('width','100%');
    })
</script>