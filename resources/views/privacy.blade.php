@extends('frontend.layouts.login',['mainclass'=>'faq_page policy_pages'])

@section('content')

    <style>

        #c23 .accordion-body ul li a {

            color: red;

            word-wrap: break-word;

        }

        ul {

            list-style-type: none;

            padding: 0;

        }



        li {

            list-style-type: none;

        }

        .contact_form .form_content_box {

             margin-left: unset !important;

             transform: unset!important;

        }

        .form_content_box.contact_box {

            min-width: 70%;

        }

        /*img.site_logo.mb-1 {*/

        /*    display: none;*/

        /*}*/

        .accordion-button:focus{

            outline: none!important;

            box-shadow: none!important;

        }

        .accordion-button,.accordion-button:not(.collapsed) {

            background: #F4A640;

            color: #0A0951;

            font-weight: 700;

            font-size: 16px;

        }

        .accordion-item {

            padding-bottom: 3px;

        }

        .form_content_box.contact_box .form_body{

            padding: 0!important;

        }

        .registration_row{

            height: auto!important;

        }

        .contact_form .form_body .form_header {

            background-color: #FFFFFF;

            padding-top: 50px;

            padding-bottom: 24px;

        }

        div#accordionExample {

            background: white;

            padding: 18px;

        }

    </style>

    <div class="container-fluid" style="padding-bottom: 30px;">

        <div class="row registration_row">

            <div class="col-md-12 px-0  d-flex align-items-center">

                <div class="form_content_box contact_box mx-auto w-100" style="margin-left: auto!important;">

                    <div class="form_header text-center position-relative">

                        <a href="{{URL::to ('/')}}"><img class="site_logo mb-1" src="{!! url('frontend_assets/images/site-logo.png') !!}" alt=""></a>

                    </div>

                    <div class="form_body">

                        <div class="form_header text-center">

                            <div class="form_title">

                                <h2 class="heading">Privacy Policy</h2>

                            </div>

                        </div>



                        <div>

                            <div class="accordion" id="accordionExample">

                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><strong><span style="font-size:18.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">What is Collected</span></span></span></strong></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">First Pass Driving School collects your personal information when you use the website and communicate by email or phone. This information can include your name, contact information, phone numbers and payment information.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">We may also collect non-personal information such as usage as your IP address, browser version, operating system which may be released in anonymous form such as a report publishing our website usage trends.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Any credit card details are processed securely in Stripe&#39;s PCI compliant payment gateway using a secure HTTPS internet connection.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Like most websites, First Pass Driving School uses cookies to store a user&#39;s website preferences. If you do not wish to have cookies placed on your computer, you should set your browser to refuse cookies before using our website, with the drawback that certain features will not function properly without the aid of cookies.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><strong><span style="font-size:18.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">How it is used</span></span></span></strong></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">The personal information that is collected to provide is for billing, identification, authentication, service improvement, research and website development.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">First Pass Driving School will not share your personal information to anyone except to assist with a lawful investigation, comply with the law, provide the requested services, develop our products, protect our rights or to contact you.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Some third party service providers such as website hosts, payment service providers and backup service providers may have access to personal information held by us that a) need to know that information in order to process it on behalf of First Pass Driving School or to provide services available at the First Pass Driving School website and b) have agreed not to disclose it to others.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Aggregated non-personal data is collected by First Pass Driving School may be shared with third parties in order to improve the First Pass Driving School website.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><strong><span style="font-size:18.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Social Media</span></span></span></strong></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">First Pass Driving School may tag you in a photo on Social Media or include your Facebook profile photo if you leave a testimonial. You can request for photo to not be displayed or shared.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><strong><span style="font-size:18.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Business Transfers</span></span></span></strong></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">If First Pass Driving School was acquired, or in the unlikely event that it goes out of business or enters bankruptcy, user information would be one of the assets that is transferred or acquired by a third party. You acknowledge that such transfers may occur, and that any acquirer of First Pass Driving School may continue to use your personal information as set forth in this policy.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><strong><span style="font-size:18.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Privacy Policy Changes</span></span></span></strong></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Although most changes are likely to be minor, First Pass Driving School may change its Privacy Policy from time to time, and at First Pass Driving School sole discretion. We encourage users to frequently check this page for any changes to its Privacy Policy. Your continued use of this site after any change in this Privacy Policy will constitute your acceptance of such change.</span></span></span></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><strong><span style="font-size:18.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Questions or complaints</span></span></span></strong></span></span></p>



                                <p><span style="font-size:11pt"><span style="font-family:Calibri,&quot;sans-serif&quot;"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">Your privacy is taken seriously. You can contact First Pass Driving School anytime at </span></span></span><a href="mailto:info@firstpass.com.au"><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c">support@firstpass.com.au</span></span></span></a><span style="font-size:12.0pt"><span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><span style="color:#08004c"> with any questions or complaints regarding how your personal information is handled. </span></span></span></span></span></p>



                                <p>&nbsp;</p>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection



@section('script')



@endsection





