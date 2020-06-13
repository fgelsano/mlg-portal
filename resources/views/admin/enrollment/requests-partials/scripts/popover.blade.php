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

    $('.caption-link').click(function(){
        $('#document-img').attr('src',$(this).attr('data-img'));
        $('#document-title').text($(this).find('p').text());
        $('#document-viewer').modal('show');
    })
</script>