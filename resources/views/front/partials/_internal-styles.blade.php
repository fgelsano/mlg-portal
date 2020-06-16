<style>
    body{
        background-color: #fff;
        font-family: 'Roboto', sans-serif;
    }

    .merriweather{
        font-family: 'Merriweather', serif;
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
        opacity: 1;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;            
    }

    /* #profile-pic-container:hover #profile-pic{
        opacity: 0.3;
    }

    #profile-pic-container:hover .overlay{
        opacity: 1;
    } */
    .capture-btn:hover{
        background-color: rgba(50,50,250,0.8)!important;
    }

    .capture-btn {
        background-color: rgba(50,50,250,0.5);
        color: white;
        font-size: 16px;
        padding: 125px 30px;
        cursor: pointer;
        height: 270px;
        width: 270px;
        transition: background 1s;
    }

    #camera,
    video{
        width: 100% !important;
    }

    .dropify-wrapper .dropify-message p{
        font-size: 15px !important;
    }

    @media print {
        #print-btn{
            display: none;
        }
        #printContents{
            margin-top: 180px!important;
        }
        #admission-submitted{
            margin-top: 100px !important;
        }
    }

    /* Style the input fields */
    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    .invalid {
        background-color: #ffdddd !important;
    }

    /* ##################################### */
    .multisteps-form__progress {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
    }

    .multisteps-form__progress-btn {
        transition-property: all;
        transition-duration: 0.15s;
        transition-timing-function: linear;
        transition-delay: 0s;
        position: relative;
        padding-top: 20px;
        color: rgba(108, 117, 125, 0.7);
        text-indent: -9999px;
        border: none;
        background-color: transparent;
        outline: none !important;
        cursor: pointer;
    }

    @media (min-width: 500px) {
        .multisteps-form__progress-btn {
            text-indent: 0;
        }
    }

    .multisteps-form__progress-btn:before {
        position: absolute;
        top: 0;
        left: 50%;
        display: block;
        width: 13px;
        height: 13px;
        content: '';
        -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
        transition: all 0.15s linear 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
        transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
        transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
        border: 2px solid currentColor;
        border-radius: 50%;
        background-color: #fff;
        box-sizing: border-box;
        z-index: 3;
    }

    .multisteps-form__progress-btn:after {
        position: absolute;
        top: 5px;
        left: calc(-50% - 13px / 2);
        transition-property: all;
        transition-duration: 0.15s;
        transition-timing-function: linear;
        transition-delay: 0s;
        display: block;
        width: 100%;
        height: 2px;
        content: '';
        background-color: currentColor;
        z-index: 1;
    }

    .multisteps-form__progress-btn:first-child:after {
        display: none;
    }

    .multisteps-form__progress-btn.js-active {
        color: #007bff;
    }

    .multisteps-form__progress-btn.js-active:before {
        -webkit-transform: translateX(-50%) scale(1.2);
                transform: translateX(-50%) scale(1.2);
        background-color: currentColor;
    }

    .multisteps-form__form {
        position: relative;
    }

    .multisteps-form__panel {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        opacity: 0;
        display: none;
    }

    .multisteps-form__panel.js-active {
        height: auto;
        opacity: 1;
        display: block;
    }

    .multisteps-form__panel[data-animation="scaleIn"] {
        -webkit-transform: scale(0.9);
                transform: scale(0.9);
    }

    .multisteps-form__panel[data-animation="scaleIn"].js-active {
        transition-property: all;
        transition-duration: 0.2s;
        transition-timing-function: linear;
        transition-delay: 0s;
        -webkit-transform: scale(1);
                transform: scale(1);
        margin-bottom: 100px;
    }

    .uploaded-doc{
        height: 300px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        border: 15px solid #fff;
    }

    .uploaded-doc p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }
</style>