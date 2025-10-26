<!DOCTYPE html>
<html lang="bn">

<head>
  <meta charset="UTF-8">
  <title>প্রবেশপত্র</title>
  <style>
    body {
      font-family: 'Siyam Rupali', 'SolaimanLipi', sans-serif;
      background-color: #fff;
      padding: 20px;
    }

    .admit-card {
      width: 700px;
      border: 3px solid #4CAF50;
      padding: 20px;
      margin: auto;
      text-align: center;
    }

    .admit-card h2 {
      margin: 0;
      font-size: 26px;
    }

    .admit-card h4 {
      margin: 0;
      font-size: 18px;
    }

    .title-box {
      background-color: #000;
      color: #fff;
      font-size: 24px;
      font-weight: bold;
      padding: 5px 10px;
      display: inline-block;
      margin: 15px 0;
    }

    .photo {
      float: right;
      border: 1px solid #f97316;
      width: 100px;
      height: 120px;
      margin-top: -80px;
      background-image: url('https://via.placeholder.com/100x120');
      background-size: cover;
      background-position: center;
    }

    .info {
      text-align: left;
      margin-top: 20px;
    }

    .info pre {
      font-size: 18px;
      margin: 8px 0;
    }

    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 60px;
      padding: 0 30px;
    }

    .signatures div {
      text-align: center;
      font-size: 16px;
    }

    .line {
      border-top: 1px solid #000;
      width: 150px;
      margin: auto;
      margin-bottom: 4px;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<body>
  <div class="admit-card" id="capture">
    <h2>তালীমুল ইসলাম স্কুল এন্ড মাদরাসা</h2>
    <h4>{{ $exam->name ?? 'পরীক্ষা' }} : {{ \Carbon\Carbon::parse($exam->start_date)->format('Y') ?? '' }}</h4>
    <div class="title-box">প্রবেশপত্র</div>
    <div class="photo"
      style="background-image: url('{{ asset($student->image ? 'img/profile/' . $student->image : 'https://via.placeholder.com/100x120') }}');">
    </div>

    <div class="info">
      <pre>শিক্ষার্থীর নাম: {{ $student->student_name }}</pre>
      <pre>শ্রেণি: {{ $student->sreni->name ?? '....................' }}                শাখা: {{ $student->bibag->name ?? '' }}</pre>
      <pre>রোল নং: {{ $student->roll_number ?? '....................' }}             আইডি নং: {{ $student->dhakila_number ?? '....................' }}</pre>
    </div>

    <div class="signatures">
      <div>
        <div class="line"></div>
        শিক্ষার্থীর স্বাক্ষর
      </div>
      <div>
        <div class="line"></div>
        প্রিন্সিপাল স্বাক্ষর
      </div>
    </div>
  </div>


  <button onclick="captureComponent()"
    style="background: darkblue; color:white; padding:10px; border:none; align-self: flex-start; margin-top: 20px; display:block; margin:auto; width:250px; margin-top:20px;">Capture
    Image</button>




  <script>
    function captureComponent() {
      const element = document.getElementById("capture");

      // Copy computed styles to inline styles
      function applyInlineStyles(el) {
        const computedStyle = window.getComputedStyle(el);
        for (let key of computedStyle) {
          el.style[key] = computedStyle.getPropertyValue(key);
        }
        Array.from(el.children).forEach(child => applyInlineStyles(child));
      }

      // Clone and apply styles
      const clonedElement = element.cloneNode(true);
      applyInlineStyles(clonedElement);
      document.body.appendChild(clonedElement);

      html2canvas(clonedElement).then(canvas => {
        let imgURL = canvas.toDataURL("image/png");
        let link = document.createElement("a");
        link.href = imgURL;
        link.download = "captured-image.png";
        link.click();

        document.body.removeChild(clonedElement);
      });
    }
  </script>
</body>

</html>