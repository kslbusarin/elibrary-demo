<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>elibrary</title>
    
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
    
        <script src="../js/controller/environment.js"></script>
        <!-- Favicons -->
		<meta charset="UTF-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0" />
		<title>Book list</title>
	</head>
	<body>
        <div class="container py-3">
            <header>
                <div id="nav-placeholder"></div>
            </header>

        </div>
        <script src="../js/libs/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="../js/libs/jquery.min.js"></script>
        <script>
            $(function(){
                Swal.fire({
                                html: '<h5>ข้อกำหนดในการเข้าใช้บริการระบบ PSU eLibrary มหาวิทยาลัยสงขลานครินทร์</h5><p align="left" style="font-size: 0.875em;  padding-left:5%; padding-right:5%; text-indent: 2%;">PSU eLibrary เป็นรูปแบบการให้บริการการอ่านเอกสารฉบับเต็มในรูปแบบออนไลน์ เสมือนหนึ่งผู้ใช้บริการกำลังใช้บริการอยู่ภายในหอสมุดของมหาวิทยาลัยสงขลานครินทร์ มีวัตถุประสงค์ เพื่อให้บริการเอกสารสำหรับการศึกษา การแสวงหาความรู้และการวิจัยเท่านั้น ห้ามมิให้ดาวน์โหลด ดัดแปลง ทำซ้ำหรือเผยแพร่เนื้อหา อีกทั้งไม่อนุญาตให้นำไปใช้แสวงหาผลประโยชน์ทางการค้า ไม่ว่ากรณีใด ๆ ทั้งสิ้น และต้องอ้างอิงถึงเจ้าของเอกสารทุกครั้งที่มีการนำไปใช้'+
                                'ผู้ใช้บริการ PSU eLibrary จำเป็นต้องปฏิบัติตามข้อกำหนดการใช้บริการ ดังต่อไปนี้</p>'+
                                '<ol type="1" align="left" style="font-size: 0.875em;  padding-left:5%; padding-right:5%;"><li>ผู้ใช้บริการต้องเป็นนักศึกษาและบุคลากรปัจจุบันของมหาวิทยาลัยสงขลานครินทร์ เพื่อเข้าใช้บริการยืมและอ่านเอกสารฉบับเต็มแบบออนไลน์ โดยการยืนยันตัวตนด้วย PSU Passport อันเป็นส่วนหนึ่งของกระบวนการลงทะเบียนใช้บริการ และการใช้บริการอย่างต่อเนื่อง</li>'+
                                '<li style="text-indext: 2%">ระบบจะสร้างลายน้ำ (Water Mark) ลงบนไฟล์เอกสารฉบับเต็มในระบบ PSU eLibrary ซึ่งประกอบด้วย ชื่อ-สกุลผู้ยืม วันที่ยืมและวันที่คืนเอกสาร ห้ามมิให้ผู้ใช้บริการกระทำการอย่างหนึ่งอย่างใดในความพยายามจะนำลายน้ำ (Water Mark) ดังกล่าวออก หากมีการตรวจพบมหาวิทยาลัยขอสงวนสิทธิ์ในการดำเนินการอย่างหนึ่งอย่างใด ทั้งทางวินัยหรือทางกฏหมาย</li>'+
                                '<li style="text-indext: 2%">สำหรับไฟล์เอกสารฉบับเต็มในระบบ PSU eLibrary ลิขสิทธิ์ของไฟล์เอกสารยังคงเป็นสิทธิ์ของเจ้าของผลงานหรือสำนักพิมพ์ ห้ามมิให้ผู้ใช้บริการดาวน์โหลดหรือพยายามจะดาวน์โหลดออกไปจากระบบ หากมีการตรวจพบมหาวิทยาลัยขอสงวนสิทธิ์ในการดำเนินการอย่างหนึ่งอย่างใด ทั้งทางวินัยหรือทางกฏหมาย'+
                                '<li style="text-indext: 2%">ไฟล์เอกสารฉบับเต็มในระบบ PSU eLibrary มีอายุการใช้งาน หรือไม่สามารถเรียกดูไฟล์นั้นได้ ภายใน ระยะเวลา 14 วัน หลังจากวันที่ยืม เพื่อส่งเสริมการใช้งานอย่างเป็นธรรม (Fair use) โดยคำนึงถึงลิขสิทธิ์แก่ผู้มีส่วนได้ส่วนเสีย'+
                                '<li style="text-indext: 2%">การยืมไฟล์เอกสารฉบับเต็มในระบบ PSU eLibrary ของผู้ใช้บริการจะมีการบันทึกสถิติการใช้งานและข้อมูลส่วนบุคคลไว้ทุกครั้ง เพื่อพัฒนาระบบและการบริการที่ตอบสนองต่อความต้องการของสมาชิก โดยเก็บรวบรวมและใช้ข้อมูลส่วนตัว ประกอบด้วย ชื่อ-นามสกุล รหัสนักศึกษาหรือรหัสบุคลากร คณะหรือหน่วยงานที่สังกัด อีเมล โดยสำนักทรัพยากรการเรียนรู้คุณหญิงหลง อรรถกระวีสุนทร สามารถใช้ฐานประโยชน์โดยชอบด้วยกฎหมายได้ โดยไม่ต้องขอความยินยอมจากเจ้าของข้อมูลส่วนบุคคล สำนักฯ จะเก็บข้อมูลส่วนบุคคลดังกล่าว เฉพาะช่วงระยะเวลาที่มีสถานะเป็นนักศึกษาหรือบุคลากรปัจจุบันของมหาวิทยาลัยสงขลานครินทร์เท่านั้น'+
                                'ผู้ใช้บริการจะเป็นผู้รับผิดชอบแต่เพียงผู้เดียวต่อบุคคลใด ๆ ในความเสียหายอันเกิดจากการละเมิดข้อกำหนด</li></ol>'+
                                '<p align="left" style="font-size: 0.875em; text-indent: 2%; padding-left:5%; padding-right:5%;">ผู้ใช้บริการได้รับข้อมูลและคำอธิบายเกี่ยวกับข้อกำหนดในการเข้าใช้บริการระบบ PSU eLibrary นี้แล้ว ผู้ใช้บริการมีเวลาเพียงพอในการอ่านและทำความเข้าใจกับข้อมูลในข้อกำหนดในการเข้าใช้บริการระบบ PSU eLibrary นี้อย่างถี่ถ้วน เมื่อกด “ยอมรับ” แสดงว่าผู้ใช้บริการตกลง ยอมรับผูกพัน ปฏิบัติตามข้อกำหนดและเงื่อนไขข้างต้นในการเข้าใช้บริการระบบ PSU eLibrary เหล่านี้ทั้งหมด</p>',
                                icon: 'info',
                                showDenyButton: true,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'ยอมรับ',
                                denyButtonText: `ปฏิเสธ`,
                                width: '80%'
                            }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                location.href = '../home';

                                    // show(body);
                            } 
                            // else if (result.isDenied) {
                            //     Swal.fire('Changes are not saved', '', 'info')
                            // }
                            })

            });
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</body>
</html>
