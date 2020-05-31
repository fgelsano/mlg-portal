<style>
    body{
        background-color: #fff;
        font-family: 'Roboto', sans-serif;
    }

    .merriweather{
        font-family: 'Merriweather', serif;
    }

    .inputDnD .form-control-file {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 5em;
        outline: none;
        visibility: hidden;
        cursor: pointer;
        background-color: #ccc;
        box-shadow: 0 0 2px solid currentColor;
    }
        
    .inputDnD .form-control-file:before {
        content: attr(data-title);
        position: absolute;
        left: 0;
        width: 100%;
        min-height: 5em;
        padding: 15px 15px 0px;
        opacity: 1;
        visibility: visible;
        text-align: center;
        border: 0.05em dashed currentColor;
        -webkit-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        overflow: visible;
        background-color: #eee;
    }

    .inputDnD .form-control-file:hover:before {
        border-style: solid;
        box-shadow: inset 0px 0px 0px 2px red;
        color: red;
    }

    #profile-pic{
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    #profile-pic:hover{
        cursor: pointer;
    }
    .overlay{
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;            
    }

    #profile-pic-container:hover #profile-pic{
        opacity: 0.3;
    }

    #profile-pic-container:hover .overlay{
        opacity: 1;
    }

    .capture-btn{
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        padding: 15px 30px;
        cursor: pointer;
    }

    #camera,
    video{
        width: 100% !important;
    }

    @media print {
        #print-btn{
            display: none;
        }
        #printContents{
            margin-top: 180px!important;
        }
    }
</style>