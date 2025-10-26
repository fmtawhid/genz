<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher ID Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>

    <div class="flex justify-center gap-4 mt-[100px]" id="capture">

        <!-- frontSide-start -->
        <section class="max-w-screen-sm">
            <div class="rounded-3xl bg-gradient-to-r from-orange-600 via-orange-200 to-orange-600 py-4 w-[365px]">
                <div class="bg-white rounded-3xl w-full py-1 px-[6px] border border-gray-500/30" style="padding:18px;">
                    <div class="flex flex-col gap-y-3 items-center">
                        <div class="h-10 w-10 rounded-full">
                            <img src="{{ asset('assets/img/idCard.jpeg') }}" alt="schoolLogo" class="h-full w-full rounded-full">
                        </div>

                        <div class="w-full text-center">
                            <h2 class="text-[24px] font-bold font-sans text-[#835331]">
                                Talimul Islam School <span class="block">&</span> Madrasa
                            </h2>
                        </div>

                        <div class="h-[120px] w-[120px] border-[3px] border-[#835331] rounded-[0px]">
                            <img src="{{ asset($teacher->image ? 'img/teachers/' . $teacher->image : 'https://pinnacle.works/wp-content/uploads/2022/06/dummy-image.jpg') }}" alt="profileImg" class="h-full w-full rounded-[0px] object-cover">
                        </div>
                        <div class="text-center font-medium text-lg font-mono">
                            {{ $teacher->name }}
                        </div>
                        
                        <td class="text-sm font-normal font-mono capitalize">{{ $teacher->designation }}</td>
                    </div>

                    <div class="mt-4">
                        <table class="w-full table-auto">
                            <tr>
                                <td class="px-4 text-sm font-bold font-mono capitalize">User ID</td>
                                <td class="px-4 text-center">:</td>
                                <td class="px-4 text-sm font-normal font-mono capitalize">{{ $teacher->user_id ?? 'Not Set' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 text-sm font-bold font-mono capitalize">Joining Date</td>
                                <td class="px-4 text-center">:</td>
                                <td class="px-4 text-sm font-normal font-mono capitalize">{{ $teacher->date_of_joining }}</td>
                            </tr>
                            

                            <tr>
                                <td class="px-4 text-sm font-bold font-mono capitalize">Phone</td>
                                <td class="px-4 text-center">:</td>
                                <td class="px-4 text-sm font-normal font-mono capitalize">{{ $teacher->phone_number }}</td>
                            </tr>
                            
                            <tr>
                                <td class="px-4 text-sm font-bold font-mono capitalize">Blood Group</td>
                                <td class="px-4 text-center">:</td>
                                <td class="px-4 text-sm font-normal font-mono capitalize">{{ $teacher->blood_group ?? 'N/A' }}</td>
                            </tr>
                            <br>
                            
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- frontSide-end -->

        <!-- backSide-start -->
        <section class="max-w-screen-sm">
            <div class="w-[365px] bg-gradient-to-r from-orange-600 via-orange-200 to-orange-600 rounded-xl py-[44px]">
                <div class="bg-white border border-gray-500/30 pt-2 pb-4">
                    <div class="h-[10px] w-full bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600"></div>
                    <div class="h-5 w-full bg-white mt-4"></div>
                    <div class="flex flex-col items-center gap-y-3">
                        <div class="w-full text-center">
                            <h2 class="text-[20px] font-bold font-sans capitalize text-pretty">
                                If lost please return to the following address
                            </h2>
                        </div>

                        <div class="h-[120px] w-[120px]">
                            <img src="{{ asset('assets/img/idCard.jpeg') }}" alt="institutionLogo">
                        </div>

                        <div>
                            <h2 class="text-[24px] font-bold font-sans capitalize text-center text-[#835331]">
                                Talimul Islam School <span class="block">&</span> Madrasa
                            </h2>
                        </div>

                        <div class="flex flex-col gap-y-2 mt-2">
                            <h2 class="text-base font-medium font-sans">
                                C & B Road, Sadar, Dinajpur.
                            </h2>
                            <h2 class="text-base font-medium font-sans">
                                Mobile: +8801322926843
                            </h2>
                            <h2 class="text-base font-medium font-sans">
                                Email: taimulIslamdnj@gmail.com
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- backSide-end -->

    </div>

    <button onclick="captureComponent()" style="background: darkblue; color:white; padding:10px; border:none; align-self: flex-start; margin:auto; display:block; width:250px; margin-top:20px;">Capture Image</button>

    <script>
        function captureComponent() {
            const element = document.getElementById("capture");

            function applyInlineStyles(el) {
                const computedStyle = window.getComputedStyle(el);
                for (let key of computedStyle) {
                    el.style[key] = computedStyle.getPropertyValue(key);
                }
                Array.from(el.children).forEach(child => applyInlineStyles(child));
            }

            const clonedElement = element.cloneNode(true);
            applyInlineStyles(clonedElement);
            document.body.appendChild(clonedElement);

            html2canvas(clonedElement).then(canvas => {
                let imgURL = canvas.toDataURL("image/png");
                let link = document.createElement("a");
                link.href = imgURL;
                link.download = "teacher-id-card.png";
                link.click();
                document.body.removeChild(clonedElement);
            });
        }
    </script>

</body>
</html>
