@extends('layouts.admin_master')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container form-container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 card p-4 shadow-lg rounded-3"
                style="background-color: #f9f9f9; border-radius: 10px;">
                <!-- SMS Form -->
                <form action="{{ route('sms.send') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="phone_number" class="control-label" style="font-weight: bold; color: #4A4A4A;">Phone
                            Number</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                            placeholder="Enter Phone Number" required
                            style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;">
                    </div>

                    <div class="mb-3">
                        <!-- Buttons to load phone numbers from different sources -->
                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students"
                            style="border-radius: 8px; font-weight: bold; border: none;">All Student</button>
                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-teachers"
                            style="border-radius: 8px; font-weight: bold; border: none;">All Teacher</button>
                        <button type="button" class="btn btn-secondary" id="load-all-phone-numbers"
                            style="border-radius: 8px; font-weight: bold; border: none;">All Numbers</button>

                        <!-- Button to clear the input field -->
                        <button type="button" class="btn btn-danger" id="clear-phone-numbers"
                            style="border-radius: 8px; font-weight: bold; border: none;">Clear</button>
                        <br><br>
                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students5"
                            style="border-radius: 8px; font-weight: bold; border: none;margin-bottom:10px;">Class
                            Play</button>

                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students6"
                            style="border-radius: 8px; font-weight: bold; border: none;margin-bottom:10px;">Class
                            Nursery</button>
                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students3"
                            style="border-radius: 8px; font-weight: bold; border: none;margin-bottom:10px;">Class
                            One</button>
                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students4"
                            style="border-radius: 8px; font-weight: bold; border: none;margin-bottom:10px;">Class
                            Two</button>

                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students7"
                            style="border-radius: 8px; font-weight: bold; border: none;margin-bottom:10px;">Class
                            Three</button>

                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students8"
                            style="border-radius: 8px; font-weight: bold; border: none;">Class Four</button>

                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students9"
                            style="border-radius: 8px; font-weight: bold; border: none;">Class Five</button>

                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students10"
                            style="border-radius: 8px; font-weight: bold; border: none;">Class Najera</button>

                        <button type="button" class="btn btn-secondary" id="load-phone-numbers-students11"
                            style="border-radius: 8px; font-weight: bold; border: none;">Class Hefjo</button>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select id="bibag-select" class="form-control" style="height: 35px;padding: 7px;">
                                <option value="">বিবাগ নির্বাচন করুন</option>
                                @foreach($bibags as $bibag)
                                    <option value="{{ $bibag->id }}">{{ $bibag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="sreni-select" class="form-control" style="height: 35px;padding: 7px;">
                                <option value="">স্রেনি নির্বাচন করুন</option>
                                @foreach($srenis as $sreni)
                                    <option value="{{ $sreni->id }}">{{ $sreni->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="section-select" class="form-control" style="height: 35px;padding: 7px;">
                                <option value="">সেকশন নির্বাচন করুন</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="button" class="btn btn-info" id="load-by-bibag-sreni-section">Load
                                Numbers</button>
                        </div>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label for="message" class="control-label"
                            style="font-weight: bold; color: #4A4A4A;">Message</label>
                        <textarea name="message" class="form-control" placeholder="Enter your message" required
                            oninput="updateMessage()"
                            style="border-radius: 8px; padding: 12px; border: 1px solid #ddd;"></textarea>
                    </div> --}}
                    <div class="form-group mb-3">
                        <label for="message" class="control-label"
                            style="font-weight: bold; color: #4A4A4A;">Message</label>
                        <textarea name="message" class="form-control" placeholder="Enter your message" required
                            oninput="updateMessage()"
                            style="border-radius: 8px; padding: 12px; border: 1px solid #ddd; height:100px;"
                            maxlength="160"></textarea>
                        <small id="charCount" style="color: #999;">160 characters remaining</small>
                    </div>


                    <button type="submit" class="btn btn-primary"
                        style="border-radius: 8px; font-weight: bold; border: none;">Send SMS</button>
                </form>
            </div>

            <!-- Mobile UI to display message -->
            <div class="col-md-6 col-md-offset-3 mobile-ui">
                <div class="screen">
                    <div class="message" id="mobile-message">
                        <!-- Dynamically updated message will appear here -->
                        Enter your message to see it on the screen.
                        <br><br>
                        <span class="">Gen-Z IT Institute</span>
                    </div>

                    <!-- Icons placed inside the screen -->
                    <div class="screen-icons">
                        <div class="icon menu">☰</div> <!-- তিনটি লাইন (মেনু) আইকন -->

                        <div class="icon home">◯</div> <!-- হোম আইকন (গোল) -->

                        <div class="icon back">↩</div> <!-- ব্যাক আইকন -->
                    </div>

                </div>

            </div>
        </div>
    </div>

    <style>
        /* Styling for the icons inside the screen */
        .screen-icons {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: space-between;
            width: 210px;
            font-size: 25px;
            z-index: 1;
        }

        .screen-icons .icon {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        /* .screen-icons .icon:hover {
                                                            transform: scale(1.2);
                                                            color: #007BFF;
                                                        } */

        .message {
            color: #fff;
            font-size: 18px;
            max-width: 28ch;
            text-align: center;
        }

        .message {
            /* triangle dimension */
            --b: 10px;
            /* control the base */
            --h: 5px;
            /* control the height */
            --c: #ddd;

            padding: 12px;
            border-radius: 1.2em;
            border-bottom-left-radius: 0;
            clip-path: polygon(0 0, 100% 0, 100% 100%,
                    var(--b) 100%,
                    calc(-1*var(--h)) calc(100% + var(--h)),
                    0 calc(100% - var(--b)));
            background: var(--c);
            border-image: conic-gradient(var(--c) 0 0) 0 0 999 999/ 0 0 calc(var(--h) + var(--b)) calc(var(--h) + var(--b))/0 0 var(--h) var(--h);
        }

        .form-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .mobile-ui {
            border: 1px solid #ddd;
            border-radius: 70px;
            padding: 10px;
            background-color: #CCD3D3;
            position: relative;
            text-align: center;
            width: 315px;
            margin-left: 100px;
        }

        .mobile-ui .screen {
            width: 100%;
            height: 590px;
            background: #f7f7f7;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            border-radius: 60px;
        }

        .mobile-ui .screen:before {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 50%;
            width: 100%;
            height: 50px;
            background-color: #e9e9e9;
            border-radius: 10px;
            transform: translateX(-50%);
        }

        .mobile-ui .screen:after {
            content: "";
            display: block;
            position: absolute;
            bottom: 0;
            /* নীচের দিকে */
            left: 50%;
            width: 100%;
            height: 50px;
            background-color: #e9e9e9;
            border-radius: 10px;
            transform: translateX(-50%);
        }

        .mobile-ui .screen .message {
            font-size: 12px;
            color: #333;
            line-height: 1.6;
            word-wrap: break-word;
            max-width: 90%;
            text-align: left;
            margin-left: 5px;

        }

        /* Form Styling */
        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 12px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 8px;
            padding: 10px;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Mobile responsiveness */
        @media screen and (max-width: 768px) {
            .form-container {
                margin-top: 20px;
            }

            .mobile-ui {
                margin-top: 15px;
            }
        }
    </style>
    @section('scripts')
        <script>
            // Update message dynamically as user types
            // function updateMessage() {
            //     var message = document.querySelector('textarea[name="message"]').value;
            //     var messageDiv = document.getElementById('mobile-message');
            //     messageDiv.innerHTML = message + "<br><br><span class=''>Gen-Z IT Institute</span>";
            // }
            function updateMessage() {
                var message = document.querySelector('textarea[name="message"]').value;
                var messageDiv = document.getElementById('mobile-message');
                messageDiv.innerHTML = message + "<br><br><span class=''>Gen-Z IT Institute</span>";

                var charCount = 160 - message.length;
                var charCountElement = document.getElementById('charCount');
                charCountElement.textContent = charCount + " characters remaining";

                // Change color if character limit is exceeded
                if (charCount < 0) {
                    charCountElement.style.color = "red";
                } else {
                    charCountElement.style.color = "#999"; // Reset color
                }
            }



            document.getElementById('load-phone-numbers-students').addEventListener('click', function () {
                var getPhoneNumbersUrlStudents = "{{ route('sms.getPhoneNumbersall') }}";
                fetch(getPhoneNumbersUrlStudents)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 1 (Class One)
            var getPhoneNumbersUrlStudents3 = "{{ route('sms.getPhoneNumbersclass3') }}"; // Use the correct route for Class One
            document.getElementById('load-phone-numbers-students3').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents3)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });


            // Load phone numbers for Class 2 (Class One)
            var getPhoneNumbersUrlStudents4 = "{{ route('sms.getPhoneNumbersclass4') }}"; // Use the correct route for Class One
            document.getElementById('load-phone-numbers-students4').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents4)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });
            // Load phone numbers for Class 3 (Class One)
            var getPhoneNumbersUrlStudents5 = "{{ route('sms.getPhoneNumbersclass5') }}"; // Use the correct route for Class One
            document.getElementById('load-phone-numbers-students5').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents5)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 5 (Class Five)
            var getPhoneNumbersUrlStudents5 = "{{ route('sms.getPhoneNumbersclass5') }}";
            document.getElementById('load-phone-numbers-students5').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents5)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 6
            var getPhoneNumbersUrlStudents6 = "{{ route('sms.getPhoneNumbersclass6') }}";
            document.getElementById('load-phone-numbers-students6').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents6)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 7
            var getPhoneNumbersUrlStudents7 = "{{ route('sms.getPhoneNumbersclass7') }}";
            document.getElementById('load-phone-numbers-students7').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents7)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 8
            var getPhoneNumbersUrlStudents8 = "{{ route('sms.getPhoneNumbersclass8') }}";
            document.getElementById('load-phone-numbers-students8').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents8)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 9
            var getPhoneNumbersUrlStudents9 = "{{ route('sms.getPhoneNumbersclass9') }}";
            document.getElementById('load-phone-numbers-students9').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents9)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 10
            var getPhoneNumbersUrlStudents10 = "{{ route('sms.getPhoneNumbersclass10') }}";
            document.getElementById('load-phone-numbers-students10').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents10)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            // Load phone numbers for Class 11
            var getPhoneNumbersUrlStudents11 = "{{ route('sms.getPhoneNumbersclass11') }}";
            document.getElementById('load-phone-numbers-students11').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlStudents11)  // Use the correct URL
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';  // Clear previous phone numbers
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');  // Display the phone numbers
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });





            // Load teacher phone numbers
            var getPhoneNumbersUrlTeachers = "{{ route('sms.getPhoneNumbersTeachers') }}";
            document.getElementById('load-phone-numbers-teachers').addEventListener('click', function () {
                fetch(getPhoneNumbersUrlTeachers)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('phone_number').value = '';
                            document.getElementById('phone_number').value = data.phone_numbers.join(', ');
                        } else {
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });

            var getPhoneNumbersUrl = "{{ route('sms.getAllPhoneNumbers') }}"; // All Phone Numbers রাউট

            document.getElementById('load-all-phone-numbers').addEventListener('click', function () {
                fetch(getPhoneNumbersUrl) // Student এবং Teacher টেবিল থেকে ফোন নাম্বার লোড করতে
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response data:', data); // রেসপন্স দেখতে
                        if (data.success && data.phone_numbers) {
                            // যদি phone_numbers একটি অবজেক্ট হয়, তাহলে এটিকে অ্যারে তে পরিণত করুন
                            var phoneNumbersArray = Array.isArray(data.phone_numbers) ? data.phone_numbers : Object
                                .values(data.phone_numbers);

                            document.getElementById('phone_number').value = ''; // Clear the input field
                            document.getElementById('phone_number').value = phoneNumbersArray.join(', ');
                        } else {
                            console.error('Invalid data format:', data); // Log if the format is unexpected
                            alert('Failed to load phone numbers');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading phone numbers:', error);
                    });
            });





            $('#bibag-select, #sreni-select').on('change', function () {
                var bibagId = $('#bibag-select').val();
                var sreniId = $('#sreni-select').val();
                $('#section-select').html('<option value="">সেকশন নির্বাচন করুন</option>');
                if (bibagId && sreniId) {
                    $.get("{{ route('sms.getSectionsByBibagSreni') }}", {
                        bibag_id: bibagId,
                        sreni_id: sreniId
                    }, function (data) {
                        $.each(data, function (i, section) {
                            $('#section-select').append('<option value="' + section.id + '">' + section.name + '</option>');
                        });
                    });
                }
            });

            // লোড বাটনে ক্লিক করলে নাম্বার আনো
            $('#load-by-bibag-sreni-section').on('click', function () {
                var bibagId = $('#bibag-select').val();
                var sreniId = $('#sreni-select').val();
                var sectionId = $('#section-select').val();
                $.get("{{ route('sms.getNumbersByBibagSreniSection') }}", {
                    bibag_id: bibagId,
                    sreni_id: sreniId,
                    section_id: sectionId
                }, function (data) {
                    if (data.success) {
                        $('#phone_number').val(data.phone_numbers.join(', '));
                    } else {
                        alert('No numbers found!');
                    }
                });
            });
            // Clear the phone numbers input field when clicking the clear button
            document.getElementById('clear-phone-numbers').addEventListener('click', function () {
                document.getElementById('phone_number').value = '';
            });
        </script>
    @endsection
@endsection