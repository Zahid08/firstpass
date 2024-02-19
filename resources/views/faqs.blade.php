@extends('frontend.layouts.login',['mainclass'=>'faq_page'])
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
                                <h2 class="heading">First Pass Frequently Asked Questions</h2>
                            </div>
                        </div>

                        <div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Can I use my own car for driving lessons?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Whilst we recommend you use our instructor car for your first initial lessons, once you are feeling more confident with your driving skills then we are happy to teach you in your car.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Can I pay for my lesson and/or test package now but book them later?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Yes, when making a booking on our website, you have the option to ‘continue without booking’. This allows you to come back at a later stage and select your date and time to book your driving lesson or test package.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            How many driving lessons do I need?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Your driving instructor will determine how many lessons they feel you require after your first lesson. This will give them the opportunity to assess your driving skills and knowledge base before advising you of an estimated number of lessons.</li>
                                                <li>As a new driver with limited experience we would normally recommend at least 7 to 10 hours of driving lessons with an experienced driving instructor.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c4" aria-expanded="false" aria-controls="c4">
                                            Will you complete my logbook?
                                        </button>
                                    </h2>
                                    <div id="c4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Yes, your instructor will fill in your logbook hours after every lesson. Please ensure you bring your logbook with you to each lesson.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c5" aria-expanded="false" aria-controls="c5">
                                            How long can I book a lesson for?
                                        </button>
                                    </h2>
                                    <div id="c5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Depending on how many hours you have booked will depend on the time of your lesson. You have the option to book either 1 or 2 hour lessons based on your preference.</li>
                                                <li>Typically we recommend booking a 1 hour lesson and your instructor will pick you up and drop you off at your preferred address.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c6" aria-expanded="false" aria-controls="c6">
                                            What is a driver knowledge test?
                                        </button>
                                    </h2>
                                    <div id="c6" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>The driver knowledge test (DKT) is a computer based test. This is the first stage of the drivers licence process and is composed of 45 questions.</li>
                                                <li>You are required to answer at least 41 questions correctly (12 questions correctly among the 15 general knowledge questions and at least 29 among the 30 road safety questions).</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c7" aria-expanded="false" aria-controls="c7">
                                            What is a hazard perception test?
                                        </button>
                                    </h2>
                                    <div id="c7" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>As part of the licensing process you are required to first pass the Hazard Perception Test in order to progress to your P1 licence.</li>
                                                <li>The Hazard Perception Test is a computer-based test that measures your ability to recognise dangerous situations and respond appropriately. </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c8" aria-expanded="false" aria-controls="c8">
                                            What is the minimum age to apply for a driver licence in Australia?
                                        </button>
                                    </h2>
                                    <div id="c8" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>You must be at least 16 years of age before you can apply for a driver’s licence (car class C) in Australia.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c9" aria-expanded="false" aria-controls="c9">
                                            How long will it take to get my driver’s licence?
                                        </button>
                                    </h2>
                                    <div id="c9" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>This will depend on your skills, learning abilities and consistently with driving. </li>
                                                <li>Everyone learns at a different pace so it’s important to speak to your Instructor who will assess how many hours they feel is appropriate for you to feel comfortable driving.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c10" aria-expanded="false" aria-controls="c10">
                                            Do you provide a car for the driving test?
                                        </button>
                                    </h2>
                                    <div id="c10" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Yes, you can book our driving test package for $195 which includes:</li>
                                                <li> Pick-up 1 hour prior to test start.</li>
                                                <li> 45-minute pre-test warm up lesson.</li>
                                                <li> Instructor car use for test.</li>
                                                <li> Drop-off after test result is received.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c11" aria-expanded="false" aria-controls="c11">
                                            How do I book a lesson or test package?
                                        </button>
                                    </h2>
                                    <div id="c11" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Simply enter your pickup suburb and preferred transmission type and select ‘search’. From here you will be able to choose from one of the available instructors.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c12" aria-expanded="false" aria-controls="c12">
                                            How do I know when the instructor is available?
                                        </button>
                                    </h2>
                                    <div id="c12" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>When searching for an instructor, you will be able to view their availability by clicking on their profile page. This will show you their available days and times so you can schedule your upcoming lessons.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c13" aria-expanded="false" aria-controls="c13">
                                            Do you offer bonus logbook hours?
                                        </button>
                                    </h2>
                                    <div id="c13" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Yes, driving with a NSW driving instructor, you can record triple the time of your lesson in your logbook.</li>
                                                <li>For example, if you have a 1-hour lesson, you can log 3 hours of driving practice. Applying bonus hours – a maximum of 10 hours with a driving instructor can be applied.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c14" aria-expanded="false" aria-controls="c14">
                                            How do I find a driving instructor?
                                        </button>
                                    </h2>
                                    <div id="c14" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>To find your local driving instructor, simply search your pickup suburb and preferred transmission type and select ‘search’. From here you will be able to select your local instructors.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c15" aria-expanded="false" aria-controls="c15">
                                            How do I contact my driving instructor?
                                        </button>
                                    </h2>
                                    <div id="c15" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>After booking your first lesson using our online booking system, you will be able to manage your account by simply signing in on our website, and accessing your driving instructors details.</li>
                                                <li>From here you can schedule, reschedule and cancel any upcoming driving lessons in your online account. </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c16" aria-expanded="false" aria-controls="c16">
                                            What payment options are available?
                                        </button>
                                    </h2>
                                    <div id="c16" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>We accept all major debit and credit cards including Visa, Mastercard and American Express. We also accept ‘Book now, pay later’ options such as Paypal, Afterpay and ZipPay.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c17" aria-expanded="false" aria-controls="c17">
                                            Can I cancel or reschedule my driving lesson?
                                        </button>
                                    </h2>
                                    <div id="c17" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>After booking your first lesson using our online booking system, you will be able to manage your account by simply signing in on our website. </li>
                                                <li>From here you can schedule, reschedule and cancel any upcoming driving lessons in your online account. </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c18" aria-expanded="false" aria-controls="c18">
                                            I need to be picked up and dropped off at different locations, is this ok?
                                        </button>
                                    </h2>
                                    <div id="c18" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>It is important to confirm with your instructor prior to your driving lesson to ensure that they are able to accommodate your request.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c19" aria-expanded="false" aria-controls="c19">
                                            What is marked in the driving test?
                                        </button>
                                    </h2>
                                    <div id="c19" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>You may be tested on many different driving skills such as lane changing, reverse parking, three point turns, roundabouts, road signage such as stop and give way procedures and many other topics.</li>
                                                <li>Our instructors will ensure you feel comfortable in all areas of driving.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c20" aria-expanded="false" aria-controls="c20">
                                            Can you drive straight after passing your driving test?
                                        </button>
                                    </h2>
                                    <div id="c20" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Yes you can, with your Provisional plate displayed of course.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c21" aria-expanded="false" aria-controls="c21">
                                            Will my driving instructor be conducting the driving test?
                                        </button>
                                    </h2>
                                    <div id="c21" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>No, your driving test is conducted by a professional examiner. Your instructor will wait for you to return after your test at the Service NSW location.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c22" aria-expanded="false" aria-controls="c22">
                                            What do I need to take with me to my driving test?
                                        </button>
                                    </h2>
                                    <div id="c22" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>On the day of your driving test, you need to take with you proof of identity and completed paper log book unless you are using a digital app or are exempt from the log book requirement.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c23" aria-expanded="false" aria-controls="c23">
                                            Is my test booking included in the driving test package?
                                        </button>
                                    </h2>
                                    <div id="c23" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>No, you will need to book your test online here: <a style="color:red" href="https://www.myrta.com/wps/portal/extvp/myrta/licence/tbs/tbs-login/!ut/p/z1/04_Sj9CPykssy0xPLMnMz0vMAfIjo8ziDTxcA8JCjcwNLYxNXQw83ZzNnQz9AwwNnA31wyEKcABHA_0oQvqj8CrxNkZXYBDsaWbg6RQa5h_maGxoEUJAgbsZXAFuRxbkRhhkeqYrAgDLGG77/dz/d5/L2dBISEvZ0FBIS9nQSEh/">https://www.myrta.com/wps/portal/extvp/myrta/licence/tbs/tbs-login/!ut/p/z1/04_Sj9CPykssy0xPLMnMz0vMAfIjo8ziDTxcA8JCjcwNLYxNXQw83ZzNnQz9AwwNnA31wyEKcABHA_0oQvqj8CrxNkZXYBDsaWbg6RQa5h_maGxoEUJAgbsZXAFuRxbkRhhkeqYrAgDLGG77/dz/d5/L2dBISEvZ0FBIS9nQSEh/</a></li>
                                                <li>You can also call 13 22 13 or visit a Service center in person.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c24" aria-expanded="false" aria-controls="c24">
                                            How much will my driving lesson cost?
                                        </button>
                                    </h2>
                                    <div id="c24" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>All of our instructor pricing is outlined on our website, this includes discount offers such as our driving lesson packages and driving test package. </li>
                                                <li>Simply enter your pickup suburb and preferred transmission type and select ‘search’. From here you will be able to choose from one of the available instructors and view their prices.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c25" aria-expanded="false" aria-controls="c25">
                                            Do I need to pay extra to use an instructor car?
                                        </button>
                                    </h2>
                                    <div id="c25" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>No, the pricing you see on our website for your driving lessons are final. This includes use of the instructor car and the lesson itself. There are no hidden fees or charges.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c26" aria-expanded="false" aria-controls="c26">
                                            How do I book more lessons?
                                        </button>
                                    </h2>
                                    <div id="c26" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>After booking your first lesson using our online booking system, you will be able to manage your account by simply signing in on our website.</li>
                                                <li>From here you can book more lessons with your instructor.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c27" aria-expanded="false" aria-controls="c27">
                                            Can I start driving lessons before I get my learners licence?
                                        </button>
                                    </h2>
                                    <div id="c27" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>No, you must have obtained your learner’s licence prior to completing any driving lessons however you do not require any prior driving experience to undertake lessons. That’s what we are here for.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

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


