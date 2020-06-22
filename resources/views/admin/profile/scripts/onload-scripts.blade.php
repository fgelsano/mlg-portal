<script>
    // Input Mask
    document.addEventListener('DOMContentLoaded', () => {
        for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
            const pattern = el.getAttribute("placeholder"),
                slots = new Set(el.dataset.slots || "_"),
                prev = (j => Array.from(pattern, (c,i) => slots.has(c)? j=i+1: j))(0),
                first = [...pattern].findIndex(c => slots.has(c)),
                accept = new RegExp(el.dataset.accept || "\\d", "g"),
                clean = input => {
                    input = input.match(accept) || [];
                    return Array.from(pattern, c =>
                        input[0] === c || slots.has(c) ? input.shift() || c : c
                    );
                },
                format = () => {
                    const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                        i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                        return i<0? prev[prev.length-1]: back? prev[i-1] || first: i;
                    });
                    el.value = clean(el.value).join``;
                    el.setSelectionRange(i, j);
                    back = false;
                };
            let back = false;
            el.addEventListener("keydown", (e) => back = e.key === "Backspace");
            el.addEventListener("input", format);
            el.addEventListener("focus", format);
            el.addEventListener("blur", () => el.value === pattern && (el.value=""));
        }
    });

    // Initialize Dropify
    $('.dropify').dropify();

    // Password Show
    $(document).ready(function(){
        $('.pass_show').append('<span class="ptxt">Show</span>');  
    });
        
    $(document).on('click','.pass_show .ptxt', function(){ 
        $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
        $(this).prev().attr('type', function(index, attr){
            return attr == 'password' ? 'text' : 'password'; 
            console.log(attr);
        }); 
    });  

    $(document).on('click','.ptxt', function(){
        let input = $(this).closest('input');
        input.attr('type','text');
    })

    let entries = false;
    let match = false;

    $('#password').on('keyup',function(){
        let password = $('#password').val();
        let validLength = /.{8}/.test(password);
        let hasCaps = /[A-Z]/.test(password);
        let hasNums = /\d/.test(password);
        let hasSpecials = /[~!,@#%&_\$\^\*\?\-]/.test(password);

        if(validLength == true){
            $('#char').removeClass('text-danger');
            $('#char').addClass('text-success');
        } else {
            $('#char').removeClass('text-success');
            $('#char').addClass('text-danger');
        }

        if(hasCaps == true){
            $('#caps').removeClass('text-danger');
            $('#caps').addClass('text-success');
        } else {
            $('#caps').removeClass('text-success');
            $('#caps').addClass('text-danger');
        }

        if(hasNums == true){
            $('#num').removeClass('text-danger');
            $('#num').addClass('text-success');
        } else {
            $('#num').removeClass('text-success');
            $('#num').addClass('text-danger');
        }
        
        if(hasSpecials == true){
            $('#spec').removeClass('text-danger');
            $('#spec').addClass('text-success');
        } else {
            $('#spec').removeClass('text-success');
            $('#spec').addClass('text-danger');
        }

        entries = validLength && hasCaps && hasNums && hasSpecials;
    });
    $('#password-confirm').on('keyup',function(){
        if($('#password').val() == $('#password-confirm').val()){
            $('#password-confirm').css('outline','2px solid green');
            $('#password').css('outline','2px solid green');
            match = true;
        } else {
            $('#password-confirm').css('outline','2px solid red');
            $('#password').css('outline','2px solid red');
            match = false;
        }

        if(match && entries){
            $('#resetBtn').removeClass('d-none')
        } else {
            $('#resetBtn').addClass('d-none');
        }
    })
</script>