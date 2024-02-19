@extends('layouts.app_guest')
@section('content')
    <style>
        .card-header {
            font-weight: Bold;
        }
        .card {
            color: #08004c;
        }
        .h4 {
            color: #08004c;
        }
        ul {
            list-style: none;
        }
    </style>
    <section class="ls ms s-py-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 animate" data-animation="scaleAppear">
                    <div class="hero-bg p-40">
                        <h4>First Pass Frequently Asked Questions</h4>
                        <br/>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#1">
                                    Can I use my own car for driving lessons?
                                </a>
                                </div>
                                <div id="1" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                        <li>Whilst we recommend you use our instructor car for your first initial lessons, once you are feeling more confident with your driving skills then we are happy to teach you in your car.</li>
                                    </ui>
                                </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#2">
                                    Can I pay for my lesson and/or test package now but book them later?
                                </a>
                                </div>
                                <div id="2" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Yes, when making a booking on our website, you have the option to ‘continue without booking’. This allows you to come back at a later stage and select your date and time to book your driving lesson or test package.</li>
                                        </ui>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#3">
                                        How many driving lessons do I need?
                                    </a>
                                </div>
                                <div id="3" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Your driving instructor will determine how many lessons they feel you require after your first lesson. This will give them the opportunity to assess your driving skills and knowledge base before advising you of an estimated number of lessons.</li>
                                            <li>As a new driver with limited experience we would normally recommend at least 7 to 10 hours of driving lesson with an experienced driving instructor.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#4">
                                        Will you complete my logbook?
                                    </a>
                                </div>
                                <div id="4" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Yes, your instructor will fill in your logbook hours after every lesson. Please ensure you bring your logbook with you to each lesson.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#5">
                                        How long can I book a lesson for?
                                    </a>
                                </div>
                                <div id="5" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Depending on how many hours you have booked will depend on the time of your lesson. You have the option to book either 1 or 2 hour lessons based on your preference.</li>
                                            <li>Typically we recommend booking a 1 hour lesson and your instructor will pick you up and drop you off at your preferred address.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#7">
                                        What is a driver knowledge test?
                                    </a>
                                </div>
                                <div id="7" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>The Driver Knowledge Test is computer-based test is the first stage of the driver licence process and is composed of 45 questions. </li>
                                            <li>You are required to answer at least 41 questions correctly (12 questions correctly among the 15 general knowledge questions and at least 29 among the 30 road safety questions).</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#8">
                                        What is a hazard perception test?
                                    </a>
                                </div>
                                <div id="8" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>As part of the licensing process you are required to first pass the Hazard Perception Test in order to progress to your P1 licence.</li>
                                            <li>The Hazard Perception Test is a computer-based test that measures your ability to recognise dangerous situations and respond appropriately. </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#9">
                                    What is the minimum age to apply for a driver licence in Australia?
                                    </a>
                                </div>
                                <div id="9" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>You must be at least 16 years of age before you can apply for a driver’s licence (car class C) in Australia.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#10">
                                        How long will it take to get my driver’s licence?
                                    </a>
                                </div>
                                <div id="10" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>This will depend on your skills, learning abilities and consistently with driving. </li>
                                            <li>Everyone learns at a different pace so it’s important to speak to your Instructor who will assess how many hours they feel is appropriate for you to feel comfortable driving.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#11">
                                        Do you provide a car for the driving test?
                                    </a>
                                </div>
                                <div id="11" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Yes, you can book our driving test package for $195 which includes:</li>
                                            <li>• Pick-up 1 hour prior to test start.</li>
                                            <li>• 45-minute pre-test warm up lesson.</li>
                                            <li>• instructor car use for test.</li>
                                            <li>• Drop-off after test result is received.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#12">
                                    How do I book a lesson or test package?
                                    </a>
                                </div>
                                <div id="12" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Simply enter your pickup suburb and preferred transmission type and select ‘search’. From here you will be able to choose from one of the available instructors.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#13">
                                    How do I know when the instructor is available?
                                    </a>
                                </div>
                                <div id="13" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>When searching for an instructor, you will be able to view their availability by clicking on their profile page. This will show you their available days and times so you can schedule your upcoming lessons.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#14">
                                        Do you offer bonus logbook hours?
                                    </a>
                                </div>
                                <div id="14" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Yes, driving with a NSW driving instructor, you can record triple the time of your lesson in your logbook.</li>
                                            <li>For example, if you have a 1-hour lesson, you can log 3 hours of driving practice. Applying bonus hours – a maximum of 10 hours with a driving instructor can be applied.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#15">
                                        How do I find a driving instructor?
                                    </a>
                                </div>
                                <div id="15" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>To find your local driving instructor, simply search your pickup suburb and preferred transmission type and select ‘search’. From here you will be able to select your local instructors.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#16">
                                        How do I contact my driving instructor?
                                    </a>
                                </div>
                                <div id="16" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>After booking your first lesson using our online booking system, you will be able to manage your account by simply signing in on our website, and accessing your driving instructors details.</li>
                                            <li>From here you can schedule, reschedule and cancel any upcoming driving lessons in your online account. </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#17">
                                        What payment options are available?
                                    </a>
                                </div>
                                <div id="17" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>We accept all major debit and credit cards including Visa, Mastercard and American Express. We also accept ‘Book now, pay later’ options such as Paypal, Afterpay and ZipPay.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#18">
                                        Can I cancel or reschedule my driving lesson?
                                    </a>
                                </div>
                                <div id="18" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>WAfter booking your first lesson using our online booking system, you will be able to manage your account by simply signing in on our website. </li>
                                            <li>From here you can schedule, reschedule and cancel any upcoming driving lessons in your online account. </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#19">
                                        I need to be picked up and dropped off at different locations, is this ok?
                                    </a>
                                </div>
                                <div id="19" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>It is important to confirm with your instructor prior to your driving lesson to ensure that they are able to accommodate your request.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#20">
                                        What is marked in the driving test?
                                    </a>
                                </div>
                                <div id="20" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>You may be tested on many different driving skills such as lane changing, reverse parking, three point turns, roundabouts, road signage such as stop and give way procedures and many other topics.</li>
                                            <li>Our instructors will ensure you feel comfortable in all areas of driving.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#21">
                                        Can you drive straight after passing your driving test?
                                    </a>
                                </div>
                                <div id="21" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>Yes you can, with your Provisional plate displayed of course.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#22">
                                        Will my driving instructor be conducting the driving test?
                                    </a>
                                </div>
                                <div id="22" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>No, your driving test is conducted by a professional examiner. Your instructor will wait for you to return after your test at the Service NSW location.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#23">
                                        What do I need to take with me to my driving test?
                                    </a>
                                </div>
                                <div id="23" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>On the day of your driving test, you will need to take with you your proof of identity and glasses or contacts, if required to see well.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#24">
                                        Is my test booking included in the driving test package?
                                    </a>
                                </div>
                                <div id="24" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>No, you will need to book your test online here: <a style="color:red" href="https://www.myrta.com/wps/portal/extvp/myrta/licence/tbs/tbs-login/!ut/p/z1/04_Sj9CPykssy0xPLMnMz0vMAfIjo8ziDTxcA8JCjcwNLYxNXQw83ZzNnQz9AwwNnA31wyEKcABHA_0oQvqj8CrxNkZXYBDsaWbg6RQa5h_maGxoEUJAgbsZXAFuRxbkRhhkeqYrAgDLGG77/dz/d5/L2dBISEvZ0FBIS9nQSEh/">https://www.myrta.com/wps/portal/extvp/myrta/licence/tbs/tbs-login/!ut/p/z1/04_Sj9CPykssy0xPLMnMz0vMAfIjo8ziDTxcA8JCjcwNLYxNXQw83ZzNnQz9AwwNnA31wyEKcABHA_0oQvqj8CrxNkZXYBDsaWbg6RQa5h_maGxoEUJAgbsZXAFuRxbkRhhkeqYrAgDLGG77/dz/d5/L2dBISEvZ0FBIS9nQSEh/</a></li>
                                            <li>You can also call 13 22 13 or visit a Service center in person.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#25">
                                        How much will my driving lesson cost?
                                    </a>
                                </div>
                                <div id="25" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>All of our instructor pricing is outlined on our website, this includes discount offers such as our driving lesson packages and driving test package. </li>
                                            <li>Simply enter your pickup suburb and preferred transmission type and select ‘search’. From here you will be able to choose from one of the available instructors and view their prices.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#26">
                                        Do I need to pay extra to use an instructor car?
                                    </a>
                                </div>
                                <div id="26" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>No, the pricing you see on our website for your driving lessons are final. This includes use of the instructor car and the lesson itself. There are no hidden fees or charges.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#27">
                                        How do I book more lessons?
                                    </a>
                                </div>
                                <div id="27" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            <li>After booking your first lesson using our online booking system, you will be able to manage your account by simply signing in on our website.</li>
                                            <li>From here you can book more lessons with your instructor.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#28">
                                        Can I start driving lessons before I get my learners licence?
                                    </a>
                                </div>
                                <div id="28" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
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
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
