<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบเว็บสื่อการเรียนรู้ออนไลน์</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Sarabun', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        header h1 {
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page {
            display: none;
            animation: fadeIn 0.5s;
        }

        .page.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        .btn {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }

        .btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-success {
            background: #48bb78;
        }

        .btn-success:hover {
            background: #38a169;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .quiz-option {
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .quiz-option:hover {
            background: #f7fafc;
            border-color: #667eea;
        }

        .quiz-option.selected {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-fill {
            height: 100%;
            background: #48bb78;
            transition: width 0.5s;
        }

        .score-display {
            text-align: center;
            font-size: 60px;
            font-weight: bold;
            margin: 30px 0;
        }

        .score-pass { color: #48bb78; }
        .score-fail { color: #f56565; }

        .certificate {
            border: 10px solid #667eea;
            padding: 60px;
            text-align: center;
            background: white;
            position: relative;
        }

        .certificate h1 {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 20px;
        }

        .certificate .name {
            font-size: 56px;
            color: #667eea;
            font-weight: bold;
            margin: 30px 0;
        }

        .rating-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .rating-btn {
            width: 50px;
            height: 50px;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s;
        }

        .rating-btn:hover {
            border-color: #667eea;
        }

        .rating-btn.selected {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 ระบบเว็บสื่อการเรียนรู้ออนไลน์</h1>
        </header>

        <div id="homePage" class="page active">
            <div class="card">
                <h2 style="text-align: center; color: #667eea; font-size: 36px; margin-bottom: 20px;">
                    ยินดีต้อนรับสู่หลักสูตร
                </h2>
                <h3 style="text-align: center; color: #666; margin-bottom: 30px;">
                    พระนครคีรี เมืองเก่าแห่งเพชรบุรี
                </h3>
                
                <div style="text-align: left; max-width: 600px; margin: 30px auto;">
                    <h4 style="margin-bottom: 15px;">🎯 เป้าหมายการเรียนรู้:</h4>
                    <ul style="line-height: 2;">
                        <li>✅ เข้าใจประวัติศาสตร์และความสำคัญของพระนครคีรี</li>
                        <li>✅ รู้จักสถาปัตยกรรมและศิลปกรรมแบบผสมผสาน</li>
                        <li>✅ เรียนรู้วิถีชีวิตและวัฒนธรรมท้องถิ่น</li>
                        <li>✅ เข้าใจคุณค่าทางประวัติศาสตร์และการอนุรักษ์</li>
                    </ul>
                </div>
                
                <div style="text-align: center; margin-top: 40px;">
                    <button class="btn btn-success" onclick="showPage('registerPage')">
                        เริ่มเรียนเลย
                    </button>
                </div>
            </div>
        </div>

        <div id="registerPage" class="page">
            <div class="card" style="max-width: 500px; margin: 0 auto;">
                <h2 style="text-align: center; margin-bottom: 30px;">ลงทะเบียนเรียน</h2>
                <form id="registerForm" onsubmit="handleRegister(event)">
                    <div class="form-group">
                        <label>ชื่อ-นามสกุล <span style="color: red;">*</span></label>
                        <input type="text" id="userName" required placeholder="กรอกชื่อ-นามสกุล">
                    </div>
                    <div class="form-group">
                        <label>อีเมล <span style="color: red;">*</span></label>
                        <input type="email" id="userEmail" required placeholder="example@email.com">
                    </div>
                    <div class="form-group">
                        <label>องค์กร</label>
                        <input type="text" id="userOrg" placeholder="ชื่อองค์กร (ถ้ามี)">
                    </div>
                    <button type="submit" class="btn btn-success" style="width: 100%;">
                        ลงทะเบียน
                    </button>
                </form>
            </div>
        </div>

        <div id="lessonPage" class="page">
            <div class="card">
                <h2>📖 บทเรียนที่ 1: พื้นฐานการพัฒนาเว็บ</h2>
                
                <div style="margin: 20px 0;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>ความคืบหน้าการอ่าน</span>
                        <span id="progressText">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressBar" style="width: 0%"></div>
                    </div>
                </div>

                <div style="line-height: 1.8;">
                    <h3>1.1 HTML, CSS และ JavaScript</h3>
                    <p style="margin: 15px 0;">
                        HTML (HyperText Markup Language) เป็นภาษามาร์กอัปที่ใช้สร้างโครงสร้างของเว็บเพจ 
                        ประกอบด้วย Elements และ Tags ต่างๆ ที่ช่วยจัดวางเนื้อหา
                    </p>
                    <p style="margin: 15px 0;">
                        CSS (Cascading Style Sheets) ใช้ในการจัดรูปแบบและออกแบบหน้าเว็บ 
                        ช่วยทำให้เว็บไซต์มีความสวยงามและน่าสนใจ
                    </p>
                    <p style="margin: 15px 0;">
                        JavaScript เป็นภาษาโปรแกรมที่ทำให้เว็บมีความโต้ตอบ (Interactive) 
                        สามารถจัดการ Events และเปลี่ยนแปลงเนื้อหาแบบ Dynamic
                    </p>

                    <h3 style="margin-top: 30px;">1.2 Frontend Frameworks</h3>
                    <p style="margin: 15px 0;">
                        React, Vue และ Angular เป็น Framework ยอดนิยมสำหรับการพัฒนา Frontend
                        ช่วยให้การพัฒนาเว็บแอปพลิเคชันที่ซับซ้อนทำได้ง่ายและรวดเร็วขึ้น
                    </p>
                    <p style="margin: 15px 0;">
                        React ถูกพัฒนาโดย Facebook ใช้ Component-based Architecture
                        Vue มีความยืดหยุ่นสูงและเรียนรู้ง่าย
                        Angular เป็น Full Framework ที่มีครบทุกอย่าง
                    </p>

                    <h3 style="margin-top: 30px;">1.3 Backend และ Database</h3>
                    <p style="margin: 15px 0;">
                        PHP และ Node.js เป็นตัวเลือกยอดนิยมสำหรับการพัฒนา Backend
                        ทำหน้าที่จัดการ Logic ต่างๆ และเชื่อมต่อกับ Database
                    </p>
                    <p style="margin: 15px 0;">
                        Database ที่นิยมใช้ ได้แก่ MySQL, PostgreSQL (Relational Database)
                        และ MongoDB (NoSQL Database) ซึ่งแต่ละตัวมีข้อดีที่แตกต่างกัน
                    </p>
                    <p style="margin: 15px 0;">
                        การออกแบบ API ที่ดี เช่น RESTful API จะช่วยให้ Frontend และ Backend
                        สามารถสื่อสารกันได้อย่างมีประสิทธิภาพ
                    </p>
                </div>

                <div style="text-align: center; margin-top: 40px;">
                    <button class="btn btn-success" onclick="completeLesson()">
                        เสร็จสิ้นและทำแบบทดสอบ
                    </button>
                </div>
            </div>
        </div>

        <div id="quizPage" class="page">
            <div class="card">
                <h2>📝 แบบทดสอบประเมินความรู้</h2>
                <div id="quizContent"></div>
                <div id="quizResult" class="hidden"></div>
            </div>
        </div>

        <div id="surveyPage" class="page">
            <div class="card">
                <h2>📊 แบบสอบถามความพึงพอใจ</h2>
                <div id="surveyContent"></div>
            </div>
        </div>

        <div id="certificatePage" class="page">
            <div class="card">
                <h2 style="text-align: center; margin-bottom: 30px;">🎉 ยินดีด้วย! คุณผ่านหลักสูตร</h2>
                <div class="certificate">
                    <div style="font-size: 80px; color: #667eea;">🏆</div>
                    <h1>เกียรติบัตร</h1>
                    <p style="font-size: 24px; color: #666;">CERTIFICATE OF COMPLETION</p>
                    
                    <div style="border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; padding: 40px; margin: 40px 0;">
                        <p style="font-size: 18px; color: #666;">ขอมอบให้แก่</p>
                        <div class="name" id="certName"></div>
                        <p style="font-size: 18px; color: #333;">ได้ผ่านการอบรมหลักสูตร</p>
                        <h3 style="font-size: 28px; margin: 20px 0;">การออกแบบและพัฒนาเว็บแอปพลิเคชันสมัยใหม่</h3>
                        <p>คะแนน: <strong style="color: #48bb78; font-size: 24px;" id="certScore"></strong></p>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                        <div>
                            <p>วันที่ออกเกียรติบัตร</p>
                            <strong id="certDate"></strong>
                        </div>
                        <div>
                            <div style="border-top: 2px solid #333; width: 200px; margin-bottom: 10px;"></div>
                            <p>ลายเซ็นผู้อำนวยการ</p>
                        </div>
                    </div>
                    
                    <p style="margin-top: 30px; color: #666; font-size: 14px;">
                        รหัสยืนยัน: <strong id="certId"></strong>
                    </p>
                </div>
                
                <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;">
                    <button class="btn btn-success" onclick="downloadCertificate()">
                        ดาวน์โหลดเกียรติบัตร
                    </button>
                    <button class="btn" onclick="showPage('homePage')">
                        กลับหน้าหลัก
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- โหลด Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <script>
        let userData = { name: '', email: '', organization: '' };
        let quizAnswers = {};
        let surveyAnswers = {};
        let quizScore = 0;
        let lessonProgress = 0;

        const quizQuestions = [
            { id: 1, question: "การออกแบบ UX ที่ดีควรเริ่มจากอะไร?", options: ["ความต้องการของผู้ใช้", "ความสวยงาม", "เทคโนโลยี", "ความชอบส่วนตัว"], correct: 0 },
            { id: 2, question: "HTML ย่อมาจากอะไร?", options: ["Hyper Text Markup Language", "High Tech Modern Language", "Home Tool Markup Language", "Hyperlinks and Text"], correct: 0 },
            { id: 3, question: "CSS ใช้ทำอะไร?", options: ["จัดการฐานข้อมูล", "ออกแบบรูปลักษณ์และจัดรูปแบบ", "เขียน Backend Logic", "สร้าง API Endpoints"], correct: 1 },
            { id: 4, question: "PHP เป็นภาษาที่ทำงานฝั่งใด?", options: ["Client-side เท่านั้น", "Server-side", "Database Layer", "ทั้งหมดที่กล่าว"], correct: 1 },
            { id: 5, question: "Responsive Design คืออะไร?", options: ["การตอบกลับเร็ว", "การปรับขนาดตามอุปกรณ์", "การโหลดหน้าเร็ว", "การใช้สีสันหลากหลาย"], correct: 1 },
            { id: 6, question: "Framework ใดเป็น Frontend Framework?", options: ["Laravel", "React", "Django", "Express"], correct: 1 },
            { id: 7, question: "Database แบบ Relational คือ?", options: ["MongoDB", "Redis", "MySQL", "Firebase"], correct: 2 },
            { id: 8, question: "REST API ใช้ Protocol ใด?", options: ["FTP", "HTTP/HTTPS", "SMTP", "SSH"], correct: 1 },
            { id: 9, question: "Git ใช้ทำอะไร?", options: ["สร้างเว็บไซต์", "Version Control", "จัดการ Database", "ทดสอบโค้ด"], correct: 1 },
            { id: 10, question: "Node.js ทำงานบน Engine ใด?", options: ["V8", "SpiderMonkey", "Chakra", "JavaScriptCore"], correct: 0 }
        ];

        const surveyQuestions = [
            { id: 1, question: "ท่านพึงพอใจกับเนื้อหาบทเรียนโดยรวมหรือไม่?", type: "rating", required: true },
            { id: 2, question: "ความยากของเนื้อหาเหมาะสมหรือไม่?", type: "rating", required: true },
            { id: 3, question: "วัสดุการเรียนการสอนมีคุณภาพเพียงพอหรือไม่?", type: "rating", required: true },
            { id: 4, question: "แบบทดสอบช่วยให้เข้าใจเนื้อหาดีขึ้นหรือไม่?", type: "rating", required: true },
            { id: 5, question: "จำนวนคำถามในแบบทดสอบเพียงพอหรือไม่?", type: "yesno", required: true },
            { id: 6, question: "ฟีเจอร์ใดที่ควรปรับปรุง?", type: "text", required: false },
            { id: 7, question: "ใช้เวลาเรียนทั้งหมดกี่นาที?", type: "number", required: false },
            { id: 8, question: "จะนำความรู้ที่ได้ไปใช้ในงานจริงหรือไม่?", type: "rating", required: true },
            { id: 9, question: "คะแนนที่ได้สะท้อนความเข้าใจของท่านหรือไม่?", type: "rating", required: true },
            { id: 10, question: "กระบวนการลงทะเบียนสะดวกและรวดเร็วหรือไม่?", type: "rating", required: true },
            { id: 11, question: "พบปัญหาทางเทคนิคระหว่างการใช้งานหรือไม่?", type: "text", required: false },
            { id: 12, question: "ต้องการรับเกียรติบัตรในรูปแบบใด?", type: "choice", options: ["ไฟล์ PDF", "ส่งทางอีเมล", "ทั้งสองแบบ"], required: true },
            { id: 13, question: "อยากเห็นหัวข้อหรือเนื้อหาใดเพิ่มเติม?", type: "text", required: false },
            { id: 14, question: "พอใจกับความเร็วในการโหลดหน้าเว็บหรือไม่?", type: "rating", required: true },
            { id: 15, question: "คำแนะนำหรือข้อเสนอแนะเพิ่มเติม", type: "text", required: false }
        ];

        function showPage(pageId) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.getElementById(pageId).classList.add('active');
        }

        function handleRegister(e) {
            e.preventDefault();
            const name = document.getElementById('userName').value.trim();
            const email = document.getElementById('userEmail').value.trim();
            const org = document.getElementById('userOrg').value.trim();
            
            if (name.length < 2) {
                alert('กรุณากรอกชื่อ-นามสกุลให้ถูกต้อง (อย่างน้อย 2 ตัวอักษร)');
                return;
            }
            
            if (!email.includes('@')) {
                alert('กรุณากรอกอีเมลให้ถูกต้อง');
                return;
            }
            
            userData.name = name;
            userData.email = email;
            userData.organization = org;
            
            showPage('lessonPage');
            simulateReading();
        }

        function simulateReading() {
            let progress = 0;
            const interval = setInterval(() => {
                progress += 2;
                if (progress <= 100) {
                    lessonProgress = progress;
                    document.getElementById('progressBar').style.width = progress + '%';
                    document.getElementById('progressText').textContent = progress + '%';
                } else {
                    clearInterval(interval);
                }
            }, 500);
        }

        function completeLesson() {
            if (lessonProgress < 100) {
                alert('กรุณารอให้อ่านบทเรียนครบก่อน (ความคืบหน้า: ' + lessonProgress + '%)');
                return;
            }
            showPage('quizPage');
            renderQuiz();
        }

        function renderQuiz() {
            let html = '<p style="color: #666; margin-bottom: 20px;">📌 ต้องได้คะแนน 70% ขึ้นไปจึงจะผ่าน</p>';
            quizQuestions.forEach((q, i) => {
                html += '<div style="margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #e2e8f0;">';
                html += '<p style="font-weight: 600; font-size: 18px; margin-bottom: 15px;">ข้อ ' + (i+1) + '. ' + q.question + '</p>';
                q.options.forEach((opt, j) => {
                    html += '<div class="quiz-option" onclick="selectAnswer(' + q.id + ',' + j + ')" data-qid="' + q.id + '" data-idx="' + j + '">';
                    html += '<input type="radio" name="q' + q.id + '" style="margin-right: 10px;" disabled>' + opt;
                    html += '</div>';
                });
                html += '</div>';
            });
            html += '<button class="btn btn-success" style="width: 100%;" onclick="submitQuiz()">ส่งคำตอบ</button>';
            document.getElementById('quizContent').innerHTML = html;
        }

        function selectAnswer(qId, optIdx) {
            quizAnswers[qId] = optIdx;
            const opts = document.querySelectorAll('[data-qid="' + qId + '"]');
            opts.forEach(o => {
                o.classList.remove('selected');
                o.querySelector('input').checked = false;
            });
            const selected = document.querySelector('[data-qid="' + qId + '"][data-idx="' + optIdx + '"]');
            selected.classList.add('selected');
            selected.querySelector('input').checked = true;
        }

        function submitQuiz() {
            if (Object.keys(quizAnswers).length < quizQuestions.length) {
                alert('กรุณาตอบคำถามให้ครบทั้ง ' + quizQuestions.length + ' ข้อ (ตอบแล้ว ' + Object.keys(quizAnswers).length + ' ข้อ)');
                return;
            }
            
            let correct = 0;
            let results = [];
            quizQuestions.forEach(q => {
                const isCorrect = quizAnswers[q.id] === q.correct;
                if (isCorrect) correct++;
                results.push({
                    question: q.question,
                    yourAnswer: q.options[quizAnswers[q.id]],
                    correctAnswer: q.options[q.correct],
                    isCorrect: isCorrect
                });
            });
            
            quizScore = (correct / quizQuestions.length) * 100;
            
            document.getElementById('quizContent').classList.add('hidden');
            let html = '<div class="score-display ' + (quizScore >= 70 ? 'score-pass' : 'score-fail') + '">' + quizScore.toFixed(0) + '%</div>';
            html += '<h3 style="text-align: center; margin-bottom: 20px;">' + (quizScore >= 70 ? '🎉 ยินดีด้วย! คุณผ่านการทดสอบ' : '😔 เสียใจด้วย คุณยังไม่ผ่านการทดสอบ') + '</h3>';
            html += '<p style="text-align: center; margin-bottom: 30px; font-size: 18px;">ตอบถูก <strong style="color: #48bb78;">' + correct + '</strong> จาก <strong>' + quizQuestions.length + '</strong> ข้อ</p>';
            
            html += '<div style="background: #f7fafc; padding: 20px; border-radius: 8px; margin-bottom: 20px; max-height: 300px; overflow-y: auto;">';
            html += '<h4 style="margin-bottom: 15px;">📋 สรุปผลการทดสอบ:</h4>';
            results.forEach((r, i) => {
                const icon = r.isCorrect ? '✅' : '❌';
                const color = r.isCorrect ? '#48bb78' : '#f56565';
                html += '<div style="margin-bottom: 15px; padding: 10px; background: white; border-radius: 5px; border-left: 4px solid ' + color + ';">';
                html += '<p style="font-weight: 600;">' + icon + ' ข้อ ' + (i+1) + ': ' + r.question + '</p>';
                html += '<p style="margin: 5px 0; color: #666;">คำตอบของคุณ: ' + r.yourAnswer + '</p>';
                if (!r.isCorrect) {
                    html += '<p style="color: #48bb78;">คำตอบที่ถูกต้อง: ' + r.correctAnswer + '</p>';
                }
                html += '</div>';
            });
            html += '</div>';
            
            if (quizScore >= 70) {
                html += '<button class="btn btn-success" style="width: 100%;" onclick="goToSurvey()">ดำเนินการต่อ - กรอกแบบสอบถาม</button>';
            } else {
                html += '<button class="btn" style="width: 100%;" onclick="retakeQuiz()">ทำแบบทดสอบใหม่อีกครั้ง</button>';
            }
            document.getElementById('quizResult').innerHTML = html;
            document.getElementById('quizResult').classList.remove('hidden');
        }

        function retakeQuiz() {
            quizAnswers = {};
            document.getElementById('quizContent').classList.remove('hidden');
            document.getElementById('quizResult').classList.add('hidden');
            renderQuiz();
        }

        function goToSurvey() {
            showPage('surveyPage');
            renderSurvey();
        }

        function renderSurvey() {
            let html = '<p style="color: #666; margin-bottom: 20px;">📌 กรุณาตอบคำถามที่มีเครื่องหมาย * (จำเป็น)</p>';
            surveyQuestions.forEach((q, i) => {
                html += '<div style="margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #e2e8f0;" data-survey-id="' + q.id + '">';
                html += '<p style="font-weight: 600; margin-bottom: 15px;">ข้อ ' + (i+1) + '. ' + q.question + ' ' + (q.required ? '<span style="color: red;">*</span>' : '') + '</p>';
                
                if (q.type === 'rating') {
                    html += '<div class="rating-buttons">';
                    for (let r = 1; r <= 5; r++) {
                        html += '<button class="rating-btn" onclick="selectRating(' + q.id + ',' + r + ')" data-rating-id="' + q.id + '" data-value="' + r + '">' + r + '</button>';
                    }
                    html += '</div>';
                    html += '<div style="display: flex; justify-content: space-between; margin-top: 5px; font-size: 12px; color: #666;"><span>น้อยที่สุด</span><span>มากที่สุด</span></div>';
                } else if (q.type === 'yesno') {
                    html += '<div style="display: flex; gap: 10px;">';
                    html += '<button class="btn" onclick="selectYesNo(' + q.id + ',\'yes\')" data-yesno-id="' + q.id + '" data-value="yes">ใช่</button>';
                    html += '<button class="btn" onclick="selectYesNo(' + q.id + ',\'no\')" data-yesno-id="' + q.id + '" data-value="no">ไม่</button>';
                    html += '</div>';
                } else if (q.type === 'text') {
                    html += '<textarea id="survey' + q.id + '" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-family: inherit;" rows="3" placeholder="กรุณากรอกคำตอบ..."></textarea>';
                } else if (q.type === 'number') {
                    html += '<input type="number" id="survey' + q.id + '" min="0" style="width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px;" placeholder="กรุณากรอกตัวเลข">';
                } else if (q.type === 'choice') {
                    q.options.forEach(opt => {
                        html += '<div class="quiz-option" onclick="selectChoice(' + q.id + ',\'' + opt + '\')" data-choice-id="' + q.id + '" data-value="' + opt + '"><input type="radio" name="survey' + q.id + '" style="margin-right: 10px;" disabled>' + opt + '</div>';
                    });
                }
                html += '</div>';
            });
            html += '<button class="btn btn-success" style="width: 100%;" onclick="submitSurvey()">ส่งแบบสอบถามและรับเกียรติบัตร</button>';
            document.getElementById('surveyContent').innerHTML = html;
        }

        function selectRating(qId, rating) {
            surveyAnswers[qId] = rating;
            const btns = document.querySelectorAll('[data-rating-id="' + qId + '"]');
            btns.forEach(btn => {
                if (btn.dataset.value == rating) {
                    btn.classList.add('selected');
                } else {
                    btn.classList.remove('selected');
                }
            });
        }

        function selectYesNo(qId, val) {
            surveyAnswers[qId] = val;
            const btns = document.querySelectorAll('[data-yesno-id="' + qId + '"]');
            btns.forEach(btn => {
                if (btn.dataset.value == val) {
                    btn.style.background = '#667eea';
                    btn.style.color = 'white';
                } else {
                    btn.style.background = '';
                    btn.style.color = '';
                }
            });
        }

        function selectChoice(qId, val) {
            surveyAnswers[qId] = val;
            const opts = document.querySelectorAll('[data-choice-id="' + qId + '"]');
            opts.forEach(opt => {
                if (opt.dataset.value == val) {
                    opt.classList.add('selected');
                    opt.querySelector('input').checked = true;
                } else {
                    opt.classList.remove('selected');
                    opt.querySelector('input').checked = false;
                }
            });
        }

        function submitSurvey() {
            surveyQuestions.forEach(q => {
                if (q.type === 'text' || q.type === 'number') {
                    const inp = document.getElementById('survey' + q.id);
                    if (inp && inp.value.trim()) {
                        surveyAnswers[q.id] = inp.value.trim();
                    }
                }
            });
            
            const requiredQuestions = surveyQuestions.filter(q => q.required);
            const missingRequired = requiredQuestions.filter(q => !surveyAnswers[q.id]);
            
            if (missingRequired.length > 0) {
                const missingNumbers = missingRequired.map(q => surveyQuestions.indexOf(q) + 1).join(', ');
                alert('กรุณาตอบคำถามที่จำเป็น (มีเครื่องหมาย *)\nคำถามที่ยังไม่ได้ตอบ: ข้อ ' + missingNumbers);
                
                missingRequired.forEach(q => {
                    const div = document.querySelector('[data-survey-id="' + q.id + '"]');
                    if (div) {
                        div.style.background = '#fff5f5';
                        setTimeout(() => { div.style.background = ''; }, 2000);
                    }
                });
                return;
            }
            
            showCertificate();
        }

        function showCertificate() {
            showPage('certificatePage');
            document.getElementById('certName').textContent = userData.name;
            document.getElementById('certScore').textContent = quizScore.toFixed(0) + '%';
            
            const today = new Date();
            const thaiDate = today.toLocaleDateString('th-TH', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('certDate').textContent = thaiDate;
            
            const certId = 'CERT-' + today.getFullYear() + 
                          String(today.getMonth() + 1).padStart(2, '0') + 
                          String(today.getDate()).padStart(2, '0') + '-' + 
                          Math.random().toString(36).substr(2, 9).toUpperCase();
            document.getElementById('certId').textContent = certId;
        }

        function downloadCertificate() {
            // แสดง loading
            const btn = event.target;
            const originalText = btn.textContent;
            btn.textContent = 'กำลังสร้าง PDF...';
            btn.disabled = true;

            // ซ่อนปุ่มชั่วคราว
            const buttons = document.querySelector('#certificatePage .card > div:last-child');
            buttons.style.display = 'none';

            // จับภาพเกียรติบัตร
            const certificate = document.querySelector('.certificate');
            
            html2canvas(certificate, {
                scale: 2,
                backgroundColor: '#ffffff',
                logging: false,
                windowWidth: certificate.scrollWidth,
                windowHeight: certificate.scrollHeight
            }).then(canvas => {
                // สร้าง PDF
                const imgData = canvas.toDataURL('image/png');
                const pdf = new window.jspdf.jsPDF({
                    orientation: 'landscape',
                    unit: 'mm',
                    format: 'a4'
                });

                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                
                // คำนวณขนาดภาพให้พอดีกับ PDF
                const imgWidth = pdfWidth - 20;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                
                const x = 10;
                const y = (pdfHeight - imgHeight) / 2;

                pdf.addImage(imgData, 'PNG', x, y, imgWidth, imgHeight);

                // ชื่อไฟล์
                const fileName = `Certificate_${userData.name.replace(/\s+/g, '_')}_${document.getElementById('certId').textContent}.pdf`;
                pdf.save(fileName);

                // แสดงปุ่มกลับมา
                buttons.style.display = 'flex';
                btn.textContent = originalText;
                btn.disabled = false;

                alert('✅ ดาวน์โหลดเกียรติบัตร PDF สำเร็จ!\n\nไฟล์: ' + fileName + '\n\nเกียรติบัตรภาษาไทยพร้อมใช้งาน!');
            }).catch(error => {
                console.error('Error generating certificate:', error);
                buttons.style.display = 'flex';
                btn.textContent = originalText;
                btn.disabled = false;
                alert('❌ เกิดข้อผิดพลาดในการสร้างเกียรติบัตร\n\nกรุณาลองใหม่อีกครั้ง');
            });
        }
    </script>
</body>
</html>