import React, { useState, useRef } from 'react';
import { BookOpen, Award, CheckCircle, FileText, Download, Home, User, BarChart3 } from 'lucide-react';

const LearningPlatform = () => {
  const [currentPage, setCurrentPage] = useState('home');
  const [userName, setUserName] = useState('');
  const [userEmail, setUserEmail] = useState('');
  const [userOrg, setUserOrg] = useState('');
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [lessonProgress, setLessonProgress] = useState(0);
  const [quizScore, setQuizScore] = useState(null);
  const [surveyComplete, setSurveyComplete] = useState(false);
  const [quizAnswers, setQuizAnswers] = useState({});
  const [surveyAnswers, setSurveyAnswers] = useState({});
  const certificateRef = useRef(null);

  const quizQuestions = [
    {
      id: 1,
      question: "การออกแบบ User Experience (UX) ที่ดีควรเริ่มจากอะไร?",
      options: ["ความต้องการของผู้ใช้", "ความสวยงามของหน้าจอ", "เทคโนโลยีล่าสุด", "ความชอบส่วนตัว"],
      correct: 0
    },
    {
      id: 2,
      question: "React เป็น Library สำหรับสร้างอะไร?",
      options: ["Backend API", "User Interface", "Database", "Mobile App เท่านั้น"],
      correct: 1
    },
    {
      id: 3,
      question: "JWT ย่อมาจากอะไร?",
      options: ["Java Web Token", "JSON Web Token", "JavaScript Web Tool", "Joint Web Technology"],
      correct: 1
    },
    {
      id: 4,
      question: "การสร้าง PDF ในเว็บสามารถใช้ Library ใดได้บ้าง?",
      options: ["jsPDF", "Puppeteer", "WeasyPrint", "ถูกทุกข้อ"],
      correct: 3
    },
    {
      id: 5,
      question: "Responsive Design คืออะไร?",
      options: ["การตอบกลับอย่างรวดเร็ว", "การปรับขนาดหน้าจอตามอุปกรณ์", "การโหลดเร็ว", "การใช้สีสันสดใส"],
      correct: 1
    }
  ];

  const surveyQuestions = [
    { id: 1, question: "ท่านพึงพอใจกับเนื้อหาบทเรียนโดยรวมหรือไม่?", type: "rating" },
    { id: 2, question: "ความยากของเนื้อหาเหมาะสมกับความรู้ของท่านหรือไม่?", type: "rating" },
    { id: 3, question: "วัสดุสื่อ (วิดีโอ/ภาพ/เอกสาร) มีคุณภาพเพียงพอหรือไม่?", type: "rating" },
    { id: 4, question: "แบบทดสอบช่วยให้ท่านเข้าใจเนื้อหาได้ดีขึ้นหรือไม่?", type: "rating" },
    { id: 5, question: "จำนวนคำถามในแบบทดสอบเพียงพอหรือไม่?", type: "yesno" },
    { id: 6, question: "ฟีเจอร์ใดที่ท่านคิดว่าควรปรับปรุงมากที่สุด?", type: "text" },
    { id: 7, question: "ท่านใช้เวลาเรียนทั้งหมดกี่ชั่วโมง?", type: "number" },
    { id: 8, question: "ท่านคิดว่าจะนำความรู้จากคอร์สไปใช้จริงหรือไม่?", type: "rating" },
    { id: 9, question: "คะแนนที่ได้สะท้อนความเข้าใจของท่านหรือไม่?", type: "rating" },
    { id: 10, question: "ระบบการลงทะเบียน/ล็อกอินสะดวกหรือไม่?", type: "rating" },
    { id: 11, question: "ท่านพบปัญหาเทคนิคใด ๆ ระหว่างการเรียนหรือไม่?", type: "text" },

    { id: 13, question: "ท่านอยากเห็นหัวข้อใดเพิ่มเติมในอนาคต?", type: "text" },
    { id: 14, question: "ท่านพอใจกับความเร็วการโหลดหน้าเว็บหรือไม่?", type: "rating" },
    { id: 15, question: "คำแนะนำเพิ่มเติม", type: "text" }
  ];

  const handleLogin = (e) => {
    e.preventDefault();
    if (userName && userEmail) {
      setIsLoggedIn(true);
      setCurrentPage('lesson');
    }
  };

  const handleQuizSubmit = () => {
    let correct = 0;
    quizQuestions.forEach(q => {
      if (quizAnswers[q.id] === q.correct) correct++;
    });
    const score = (correct / quizQuestions.length) * 100;
    setQuizScore(score);
  };

  const handleSurveySubmit = () => {
    setSurveyComplete(true);
    setCurrentPage('certificate');
  };

  const generateCertificateId = () => {
    return 'CERT-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9).toUpperCase();
  };

  const downloadCertificate = () => {
    alert('ในระบบจริง: ไฟล์ PDF จะถูกสร้างโดย Puppeteer หรือ jsPDF และดาวน์โหลดอัตโนมัติ\n\nข้อมูลเกียรติบัตร:\n- ชื่อ: ' + userName + '\n- คะแนน: ' + quizScore.toFixed(2) + '%\n- รหัสยืนยัน: ' + generateCertificateId());
  };

  const HomePage = () => (
    <div className="text-center py-12 px-6">
      <h1 className="text-4xl font-bold text-blue-600 mb-4">ยินดีต้อนรับสู่แพลตฟอร์มการเรียนรู้ออนไลน์</h1>
      <p className="text-xl text-gray-600 mb-8">หลักสูตร: การออกแบบและพัฒนาเว็บแอปพลิเคชันสมัยใหม่</p>
      <div className="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 className="text-2xl font-semibold mb-4">เป้าหมายการเรียนรู้</h2>
        <ul className="text-left space-y-2">
          <li className="flex items-start">
            <CheckCircle className="text-green-500 mr-2 mt-1" size={20} />
            <span>เข้าใจหลักการออกแบบ UX/UI</span>
          </li>
          <li className="flex items-start">
            <CheckCircle className="text-green-500 mr-2 mt-1" size={20} />
            <span>พัฒนาเว็บด้วย React และ Node.js</span>
          </li>
          <li className="flex items-start">
            <CheckCircle className="text-green-500 mr-2 mt-1" size={20} />
            <span>สร้างระบบ Authentication และ Authorization</span>
          </li>
          <li className="flex items-start">
            <CheckCircle className="text-green-500 mr-2 mt-1" size={20} />
            <span>ออกแบบ Database และ API</span>
          </li>
        </ul>
      </div>
      {!isLoggedIn ? (
        <button onClick={() => setCurrentPage('register')} className="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
          เริ่มเรียนเลย
        </button>
      ) : (
        <button onClick={() => setCurrentPage('lesson')} className="bg-green-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-green-700 transition">
          เข้าสู่บทเรียน
        </button>
      )}
    </div>
  );

  const RegisterPage = () => {
    return (
      <div className="max-w-md mx-auto mt-12 bg-white rounded-lg shadow-lg p-8">
        <h2 className="text-2xl font-bold text-center mb-6">ลงทะเบียนเรียน</h2>
        <form onSubmit={handleLogin}>
          <div className="mb-4">
            <label className="block text-gray-700 mb-2">ชื่อ-นามสกุล *</label>
            <input
              type="text"
              required
              className="w-full border border-gray-300 rounded-lg px-4 py-2"
              value={userName}
              onChange={(e) => setUserName(e.target.value)}
            />
          </div>
          <div className="mb-4">
            <label className="block text-gray-700 mb-2">อีเมล *</label>
            <input
              type="email"
              required
              className="w-full border border-gray-300 rounded-lg px-4 py-2"
              value={userEmail}
              onChange={(e) => setUserEmail(e.target.value)}
            />
          </div>
          <div className="mb-6">
            <label className="block text-gray-700 mb-2">องค์กร/หน่วยงาน</label>
            <input
              type="text"
              className="w-full border border-gray-300 rounded-lg px-4 py-2"
              value={userOrg}
              onChange={(e) => setUserOrg(e.target.value)}
            />
          </div>
          <button type="submit" className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
            ลงทะเบียน
          </button>
        </form>
      </div>
    );
  };

  const LessonPage = () => (
    <div className="max-w-4xl mx-auto py-8 px-6">
      <h2 className="text-3xl font-bold mb-6">บทเรียนที่ 1: พื้นฐานการพัฒนาเว็บ</h2>

      <div className="mb-6">
        <div className="flex justify-between mb-2">
          <span className="text-sm text-gray-600">ความคืบหน้า</span>
          <span className="text-sm text-gray-600">{lessonProgress}%</span>
        </div>
        <div className="w-full bg-gray-200 rounded-full h-3">
          <div className="bg-blue-600 h-3 rounded-full transition-all" style={{ width: lessonProgress + '%' }}></div>
        </div>
      </div>

      <div className="bg-white rounded-lg shadow-lg p-8 mb-6">
        <h3 className="text-xl font-semibold mb-4">1.1 HTML, CSS และ JavaScript</h3>
        <p className="text-gray-700 mb-4">
          HTML (HyperText Markup Language) เป็นภาษามาร์กอัปที่ใช้สร้างโครงสร้างของเว็บเพจ
          CSS (Cascading Style Sheets) ใช้ในการจัดรูปแบบและออกแบบหน้าเว็บ
          ส่วน JavaScript เป็นภาษาโปรแกรมที่ทำให้เว็บมีความโต้ตอบและมีชีวิตชีวา
        </p>

        <h3 className="text-xl font-semibold mb-4 mt-6">1.2 Frontend Frameworks</h3>
        <p className="text-gray-700 mb-4">
          React, Vue และ Angular เป็น Framework ยอดนิยมสำหรับการพัฒนา Frontend
          ช่วยให้การจัดการ State และสร้าง Component ที่นำกลับมาใช้ได้ง่ายขึ้น
        </p>

        <h3 className="text-xl font-semibold mb-4 mt-6">1.3 Backend และ Database</h3>
        <p className="text-gray-700 mb-4">
          Node.js พร้อม Express หรือ Python กับ Django/Flask เป็นตัวเลือกยอดนิยมสำหรับ Backend
          ส่วน Database ได้แก่ PostgreSQL, MySQL สำหรับ Relational หรือ MongoDB สำหรับ NoSQL
        </p>
      </div>

      <div className="flex gap-4">
        <button
          onClick={() => { setLessonProgress(100); setCurrentPage('quiz'); }}
          className="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition"
        >
          เสร็จสิ้นและทำแบบทดสอบ
        </button>
      </div>
    </div>
  );

  const QuizPage = () => (
    <div className="max-w-4xl mx-auto py-8 px-6">
      <h2 className="text-3xl font-bold mb-6">แบบทดสอบประเมินความรู้</h2>

      {quizScore === null ? (
        <div className="bg-white rounded-lg shadow-lg p-8">
          {quizQuestions.map((q, idx) => (
            <div key={q.id} className="mb-8 pb-8 border-b last:border-b-0">
              <p className="font-semibold text-lg mb-4">ข้อ {idx + 1}. {q.question}</p>
              <div className="space-y-2">
                {q.options.map((opt, optIdx) => (
                  <label key={optIdx} className="flex items-center p-3 rounded-lg hover:bg-gray-50 cursor-pointer">
                    <input
                      type="radio"
                      name={'q' + q.id}
                      value={optIdx}
                      onChange={() => setQuizAnswers({ ...quizAnswers, [q.id]: optIdx })}
                      className="mr-3"
                    />
                    <span>{opt}</span>
                  </label>
                ))}
              </div>
            </div>
          ))}

          <button
            onClick={handleQuizSubmit}
            disabled={Object.keys(quizAnswers).length < quizQuestions.length}
            className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed"
          >
            ส่งคำตอบ
          </button>
        </div>
      ) : (
        <div className="bg-white rounded-lg shadow-lg p-8 text-center">
          <div className={'text-6xl font-bold mb-4 ' + (quizScore >= 70 ? 'text-green-600' : 'text-red-600')}>
            {quizScore.toFixed(2)}%
          </div>
          <h3 className="text-2xl font-semibold mb-4">
            {quizScore >= 70 ? '🎉 ยินดีด้วย! คุณผ่านการทดสอบ' : '😔 คุณยังไม่ผ่านการทดสอบ'}
          </h3>
          <p className="text-gray-600 mb-6">
            คุณตอบถูก {quizQuestions.filter(q => quizAnswers[q.id] === q.correct).length} จาก {quizQuestions.length} ข้อ
          </p>

          {quizScore >= 70 ? (
            <button
              onClick={() => setCurrentPage('survey')}
              className="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition"
            >
              ดำเนินการต่อ: กรอกแบบสอบถาม
            </button>
          ) : (
            <button
              onClick={() => { setQuizScore(null); setQuizAnswers({}); }}
              className="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition"
            >
              ทำแบบทดสอบใหม่
            </button>
          )}
        </div>
      )}
    </div>
  );

  const SurveyPage = () => (
    <div className="max-w-4xl mx-auto py-8 px-6">
      <h2 className="text-3xl font-bold mb-6">แบบสอบถามความพึงพอใจ (15 ข้อ)</h2>

      <div className="bg-white rounded-lg shadow-lg p-8">
        {surveyQuestions.map((q, idx) => (
          <div key={q.id} className="mb-8 pb-8 border-b last:border-b-0">
            <p className="font-semibold mb-4">ข้อ {idx + 1}. {q.question}</p>

            {q.type === 'rating' && (
              <div className="flex gap-2">
                {[1, 2, 3, 4, 5].map(rating => (
                  <button
                    key={rating}
                    onClick={() => setSurveyAnswers({ ...surveyAnswers, [q.id]: rating })}
                    className={'px-6 py-2 rounded-lg border-2 transition ' + (
                      surveyAnswers[q.id] === rating
                        ? 'bg-blue-600 text-white border-blue-600'
                        : 'border-gray-300 hover:border-blue-400'
                    )}
                  >
                    {rating}
                  </button>
                ))}
              </div>
            )}

            {q.type === 'yesno' && (
              <div className="flex gap-4">
                <button
                  onClick={() => setSurveyAnswers({ ...surveyAnswers, [q.id]: 'yes' })}
                  className={'px-8 py-2 rounded-lg border-2 transition ' + (
                    surveyAnswers[q.id] === 'yes'
                      ? 'bg-blue-600 text-white border-blue-600'
                      : 'border-gray-300 hover:border-blue-400'
                  )}
                >
                  ใช่
                </button>
                <button
                  onClick={() => setSurveyAnswers({ ...surveyAnswers, [q.id]: 'no' })}
                  className={'px-8 py-2 rounded-lg border-2 transition ' + (
                    surveyAnswers[q.id] === 'no'
                      ? 'bg-blue-600 text-white border-blue-600'
                      : 'border-gray-300 hover:border-blue-400'
                  )}
                >
                  ไม่ใช่
                </button>
              </div>
            )}

            {q.type === 'text' && (
              <textarea
                className="w-full border border-gray-300 rounded-lg p-3"
                rows={3}
                value={surveyAnswers[q.id] || ''}
                onChange={(e) => setSurveyAnswers(prev => ({ ...prev, [q.id]: e.target.value }))}
                placeholder="กรอกคำตอบของคุณ..."
              />
            )}

            {q.type === 'number' && (
              <input
                type="number"
                min="0"
                className="w-full border border-gray-300 rounded-lg px-4 py-2"
                value={surveyAnswers[q.id] || ''}
                onChange={(e) => setSurveyAnswers(prev => ({ ...prev, [q.id]: e.target.value }))}
              />
            )}

            {q.type === 'choice' && (
              <div className="space-y-2">
                {q.options.map((opt, optIdx) => (
                  <label key={optIdx} className="flex items-center p-3 rounded-lg hover:bg-gray-50 cursor-pointer">
                    <input
                      type="radio"
                      name={'survey' + q.id}
                      onChange={() => setSurveyAnswers({ ...surveyAnswers, [q.id]: opt })}
                      className="mr-3"
                    />
                    <span>{opt}</span>
                  </label>
                ))}
              </div>
            )}
          </div>
        ))}

        <button
          onClick={handleSurveySubmit}
          disabled={Object.keys(surveyAnswers).length < 10}
          className="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition disabled:bg-gray-400"
        >
          ส่งแบบสอบถาม
        </button>
      </div>
    </div>
  );

  const CertificatePage = () => {
    const certId = generateCertificateId();
    const today = new Date().toLocaleDateString('th-TH', { year: 'numeric', month: 'long', day: 'numeric' });

    return (
      <div className="max-w-5xl mx-auto py-8 px-6">
        <h2 className="text-3xl font-bold mb-6 text-center">🎉 ยินดีด้วย! คุณผ่านหลักสูตร</h2>

        <div ref={certificateRef} className="bg-white rounded-lg shadow-2xl p-12 mb-6 border-8 border-blue-600">
          <div className="text-center">
            <div className="text-blue-600 mb-4">
              <Award size={80} className="mx-auto" />
            </div>
            <h1 className="text-4xl font-bold text-gray-800 mb-2">เกียรติบัตร</h1>
            <p className="text-xl text-gray-600 mb-8">CERTIFICATE OF COMPLETION</p>

            <div className="border-t-2 border-b-2 border-gray-300 py-8 my-8">
              <p className="text-lg text-gray-600 mb-2">ขอมอบให้แก่</p>
              <h2 className="text-5xl font-bold text-blue-600 mb-4">{userName}</h2>
              <p className="text-lg text-gray-700 mb-2">ได้ผ่านการอบรมหลักสูตร</p>
              <h3 className="text-2xl font-semibold text-gray-800 mb-4">
                การออกแบบและพัฒนาเว็บแอปพลิเคชันสมัยใหม่
              </h3>
              <p className="text-gray-600">คะแนน: <span className="font-bold text-green-600">{quizScore.toFixed(2)}%</span></p>
            </div>

            <div className="flex justify-between items-end mt-8">
              <div>
                <p className="text-gray-600">วันที่ออกเกียรติบัตร</p>
                <p className="font-semibold">{today}</p>
              </div>
              <div>
                <div className="border-t-2 border-gray-800 w-48 mb-2"></div>
                <p className="text-gray-600">ลายเซ็นผู้อำนวยการ</p>
              </div>
            </div>

            <div className="mt-8 text-sm text-gray-500">
              <p>รหัสยืนยันเกียรติบัตร: <span className="font-mono font-bold">{certId}</span></p>
            </div>
          </div>
        </div>

        <div className="flex gap-4">
          <button
            onClick={downloadCertificate}
            className="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition flex items-center justify-center gap-2"
          >
            <Download size={20} />
            ดาวน์โหลดเกียรติบัตร (PDF)
          </button>
          <button
            onClick={() => setCurrentPage('home')}
            className="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition"
          >
            กลับสู่หน้าหลัก
          </button>
        </div>

        <div className="mt-8 bg-yellow-50 border-l-4 border-yellow-400 p-4">
          <p className="text-sm text-gray-700">
            <strong>หมายเหตุ:</strong> ในระบบจริง ไฟล์ PDF จะถูกสร้างโดย Puppeteer (Node.js) หรือ WeasyPrint (Python)
            พร้อมฟอนต์ภาษาไทยที่สวยงาม และสามารถส่งอีเมลอัตโนมัติหรือบันทึกไว้ใน Database
          </p>
        </div>
      </div>
    );
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
      <nav className="bg-white shadow-md">
        <div className="max-w-7xl mx-auto px-6 py-4">
          <div className="flex justify-between items-center">
            <div className="flex items-center gap-2">
              <BookOpen className="text-blue-600" size={32} />
              <span className="text-xl font-bold text-gray-800">Learning Platform</span>
            </div>

            <div className="flex gap-4">
              <button onClick={() => setCurrentPage('home')} className="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                <Home size={20} />
                <span>หน้าหลัก</span>
              </button>
              {isLoggedIn && (
                <>
                  <button onClick={() => setCurrentPage('lesson')} className="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                    <BookOpen size={20} />
                    <span>บทเรียน</span>
                  </button>
                  <button className="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                    <User size={20} />
                    <span>{userName}</span>
                  </button>
                </>
              )}
            </div>
          </div>
        </div>
      </nav>

      <main>
        {currentPage === 'home' && <HomePage />}
        {currentPage === 'register' && <RegisterPage />}
        {currentPage === 'lesson' && <LessonPage />}
        {currentPage === 'quiz' && <QuizPage />}
        {currentPage === 'survey' && <SurveyPage />}
        {currentPage === 'certificate' && <CertificatePage />}
      </main>

      <footer className="bg-gray-800 text-white mt-12 py-6">
        <div className="max-w-7xl mx-auto px-6 text-center">
          <p>© 2025 Learning Platform - ระบบเว็บสื่อการเรียนรู้ออนไลน์</p>
        </div>
      </footer>
    </div>
  );
};

export default LearningPlatform;