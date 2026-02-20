// certificate-generator.js
// ไฟล์สำหรับสร้างเกียรติบัตร PDF โดยใช้ jsPDF

class CertificateGenerator {
    constructor() {
        // ตรวจสอบว่ามี jsPDF หรือไม่
        if (typeof window.jspdf === 'undefined') {
            console.error('jsPDF library is not loaded');
            return;
        }
        this.jsPDF = window.jspdf.jsPDF;
    }

    /**
     * สร้างเกียรติบัตร PDF
     * @param {Object} data - ข้อมูลสำหรับเกียรติบัตร
     * @param {string} data.name - ชื่อผู้รับเกียรติบัตร
     * @param {string} data.email - อีเมล
     * @param {string} data.organization - องค์กร
     * @param {number} data.score - คะแนน
     * @param {string} data.date - วันที่
     * @param {string} data.certId - รหัสเกียรติบัตร
     */
    generateCertificate(data) {
        // สร้าง PDF แนวนอน ขนาด A4
        const doc = new this.jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });

        const pageWidth = doc.internal.pageSize.getWidth();
        const pageHeight = doc.internal.pageSize.getHeight();

        // วาดกรอบเกียรติบัตร
        this.drawBorder(doc, pageWidth, pageHeight);

        // เพิ่มลวดลายพื้นหลัง
        this.drawBackground(doc, pageWidth, pageHeight);

        // หัวเรื่อง
        this.drawHeader(doc, pageWidth);

        // ชื่อผู้รับเกียรติบัตร
        this.drawRecipientName(doc, data.name, pageWidth);

        // เนื้อหาหลัก
        this.drawContent(doc, data, pageWidth);

        // คะแนน
        this.drawScore(doc, data.score, pageWidth);

        // ส่วนท้าย (วันที่และลายเซ็น)
        this.drawFooter(doc, data.date, data.certId, pageWidth, pageHeight);

        // บันทึกไฟล์
        const fileName = `Certificate_${data.name.replace(/\s+/g, '_')}_${data.certId}.pdf`;
        doc.save(fileName);

        return fileName;
    }

    /**
     * วาดกรอบเกียรติบัตร
     */
    drawBorder(doc, width, height) {
        // กรอบนอก - สีม่วง
        doc.setDrawColor(102, 126, 234); // #667eea
        doc.setLineWidth(3);
        doc.rect(10, 10, width - 20, height - 20);

        // กรอบใน - สีม่วงอ่อน
        doc.setDrawColor(118, 75, 162); // #764ba2
        doc.setLineWidth(1);
        doc.rect(15, 15, width - 30, height - 30);

        // กรอบตกแต่งมุม
        this.drawCornerDecorations(doc, width, height);
    }

    /**
     * วาดลวดลายมุม
     */
    drawCornerDecorations(doc, width, height) {
        doc.setDrawColor(102, 126, 234);
        doc.setLineWidth(0.5);

        const corners = [
            { x: 20, y: 20 },      // มุมซ้ายบน
            { x: width - 20, y: 20 },      // มุมขวาบน
            { x: 20, y: height - 20 },     // มุมซ้ายล่าง
            { x: width - 20, y: height - 20 }  // มุมขวาล่าง
        ];

        corners.forEach(corner => {
            // วาดเส้นประดับมุม
            for (let i = 0; i < 3; i++) {
                const offset = i * 2;
                doc.line(corner.x - 5 + offset, corner.y - 8, corner.x - 5 + offset, corner.y - 3);
                doc.line(corner.x - 8, corner.y - 5 + offset, corner.x - 3, corner.y - 5 + offset);
            }
        });
    }

    /**
     * วาดพื้นหลัง
     */
    drawBackground(doc, width, height) {
        // วาดวงกลมโปร่งแสงเป็นลวดลาย
        doc.setFillColor(102, 126, 234);
        doc.setGState(new doc.GState({ opacity: 0.03 }));

        for (let i = 0; i < 5; i++) {
            const x = 30 + (i * 50);
            const y = 40 + (i * 20);
            doc.circle(x, y, 30, 'F');
        }

        for (let i = 0; i < 5; i++) {
            const x = width - 30 - (i * 50);
            const y = height - 40 - (i * 20);
            doc.circle(x, y, 30, 'F');
        }

        // รีเซ็ต opacity
        doc.setGState(new doc.GState({ opacity: 1 }));
    }

    /**
     * วาดหัวเรื่อง
     */
    drawHeader(doc, width) {
        // ไอคอนโล่
        doc.setFillColor(102, 126, 234);
        doc.setFontSize(40);
        doc.text('🏆', width / 2, 35, { align: 'center' });

        // คำว่า "เกียรติบัตร"
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(36);
        doc.setTextColor(102, 126, 234);
        doc.text('เกียรติบัตร', width / 2, 50, { align: 'center' });

        // CERTIFICATE OF COMPLETION
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(16);
        doc.setTextColor(150, 150, 150);
        doc.text('CERTIFICATE OF COMPLETION', width / 2, 58, { align: 'center' });

        // เส้นคั่น
        doc.setDrawColor(200, 200, 200);
        doc.setLineWidth(0.5);
        doc.line(60, 62, width - 60, 62);
    }

    /**
     * วาดชื่อผู้รับเกียรติบัตร
     */
    drawRecipientName(doc, name, width) {
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(14);
        doc.setTextColor(100, 100, 100);
        doc.text('ขอมอบให้แก่', width / 2, 75, { align: 'center' });

        // ชื่อ
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(32);
        doc.setTextColor(102, 126, 234);
        doc.text(name, width / 2, 90, { align: 'center' });

        // เส้นใต้ชื่อ
        doc.setDrawColor(102, 126, 234);
        doc.setLineWidth(0.5);
        const nameWidth = doc.getTextWidth(name);
        doc.line(width / 2 - nameWidth / 2 - 10, 92, width / 2 + nameWidth / 2 + 10, 92);
    }

    /**
     * วาดเนื้อหาหลัก
     */
    drawContent(doc, data, width) {
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(13);
        doc.setTextColor(80, 80, 80);

        let yPos = 105;

        doc.text('ได้ผ่านการอบรมหลักสูตร', width / 2, yPos, { align: 'center' });

        yPos += 10;
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(18);
        doc.setTextColor(102, 126, 234);
        doc.text('การออกแบบและพัฒนาเว็บแอปพลิเคชันสมัยใหม่', width / 2, yPos, { align: 'center' });

        yPos += 10;
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(12);
        doc.setTextColor(100, 100, 100);
        doc.text('Modern Web Application Design and Development', width / 2, yPos, { align: 'center' });

        // ข้อมูลเพิ่มเติม
        if (data.organization) {
            yPos += 10;
            doc.setFontSize(11);
            doc.text(`องค์กร: ${data.organization}`, width / 2, yPos, { align: 'center' });
        }

        if (data.email) {
            yPos += 6;
            doc.setFontSize(10);
            doc.setTextColor(120, 120, 120);
            doc.text(`อีเมล: ${data.email}`, width / 2, yPos, { align: 'center' });
        }
    }

    /**
     * วาดคะแนน
     */
    drawScore(doc, score, width) {
        const yPos = 145;

        // กล่องคะแนน
        doc.setFillColor(72, 187, 120); // สีเขียว
        doc.setDrawColor(72, 187, 120);
        doc.roundedRect(width / 2 - 30, yPos - 10, 60, 18, 3, 3, 'FD');

        // ข้อความคะแนน
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(16);
        doc.setTextColor(255, 255, 255);
        doc.text(`คะแนน ${score}%`, width / 2, yPos, { align: 'center' });

        // สถานะผ่าน
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(11);
        doc.setTextColor(72, 187, 120);
        doc.text('✓ ผ่านการทดสอบ', width / 2, yPos + 10, { align: 'center' });
    }

    /**
     * วาดส่วนท้าย
     */
    drawFooter(doc, date, certId, width, height) {
        const yPos = height - 35;

        // วันที่
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(11);
        doc.setTextColor(80, 80, 80);
        doc.text('วันที่ออกเกียรติบัตร', 40, yPos);
        doc.setFont('helvetica', 'bold');
        doc.text(date, 40, yPos + 6);

        // ลายเซ็น
        doc.setFont('helvetica', 'normal');
        doc.text('ลายเซ็นผู้อำนวยการ', width - 60, yPos);
        
        // เส้นลายเซ็น
        doc.setDrawColor(50, 50, 50);
        doc.setLineWidth(0.5);
        doc.line(width - 70, yPos - 8, width - 30, yPos - 8);
        
        doc.setFont('helvetica', 'italic');
        doc.setFontSize(10);
        doc.setTextColor(100, 100, 100);
        doc.text('(ลายเซ็นอิเล็กทรอนิกส์)', width - 60, yPos + 6);

        // รหัสยืนยัน
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(9);
        doc.setTextColor(120, 120, 120);
        doc.text(`รหัสยืนยัน: ${certId}`, width / 2, height - 20, { align: 'center' });

        // QR Code placeholder (ในระบบจริงใช้ qrcode.js สร้าง QR)
        doc.setDrawColor(200, 200, 200);
        doc.rect(width / 2 - 10, height - 18, 20, 8);
        doc.setFontSize(7);
        doc.text('QR Code', width / 2, height - 12, { align: 'center' });
    }

    /**
     * ตรวจสอบว่าโหลด jsPDF แล้วหรือยัง
     */
    static isLibraryLoaded() {
        return typeof window.jspdf !== 'undefined';
    }

    /**
     * โหลด jsPDF library
     */
    static loadLibrary() {
        return new Promise((resolve, reject) => {
            if (this.isLibraryLoaded()) {
                resolve();
                return;
            }

            const script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
            script.onload = () => resolve();
            script.onerror = () => reject(new Error('Failed to load jsPDF'));
            document.head.appendChild(script);
        });
    }
}

// Export สำหรับใช้งาน
if (typeof module !== 'undefined' && module.exports) {
    module.exports = CertificateGenerator;
} else {
    window.CertificateGenerator = CertificateGenerator;
}