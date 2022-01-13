<nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav mr-auto header-menu-list">
        <div class="form-search mb">
            {!! Form::open(['url'=>'search', 'id'=>'form-search']) !!}
            <div class="position-relative">
                <span class="ic-search"></span>
                <input type="search" name="q" class="form-control" placeholder="ค้นหาข้อมูล">
            </div>
            {{ Form::close() }}
        </div>
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('') }}">หน้าหลัก <span class="sr-only">(current)</span></a>
        </li>

        {!! NavHelper::RenderTopMenu() !!}
        
        {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                เกี่ยวกับ สค.
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">ประวัติความเป็นมา</a></li>
                <li><a class="dropdown-item" href="#">ค่านิยม วิสัยทัศน์ พันธกิจ วัฒนธรรมองค์กร</a></li>
                <li><a class="dropdown-item" href="#">ภารกิจ หน้าที่และอำนาจ</a></li>
                <li><a class="dropdown-item" href="#">โครงสร้างหน่วยงาน</a></li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">ผู้บริหาร</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">ผู้บริหาร สค.</a></li>
                        <li><a class="dropdown-item" href="#">ทำเนียบกรม</a></li>
                        <li><a class="dropdown-item" href="#">ทำเนียบผู้อำนวยการ</a></li>
                        <li><a class="dropdown-item" href="#">ผู้บริหารฝ่ายการเมือง พม.</a></li>
                        <li><a class="dropdown-item" href="#">ผู้บริหารฝ่ายข้าราชการประจำ พม.</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">ข้อมูลซีไอโอ</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">ผู้บริหารเทคโนโลยีสารสนเทศระดับสูง (DCIO)</a></li>
                        <li><a class="dropdown-item" href="#">พันธกิจด้านเทคโนโลยีสารสนเทศและการสื่อสาร</a></li>
                        <li><a class="dropdown-item" href="#">วิสัยทัศน์และนโยบายต่างๆ ด้าน ICT</a></li>
                        <li><a class="dropdown-item" href="#">การบริหารงานด้าน ICT</a></li>
                        <li><a class="dropdown-item" href="#">ข่าวสารจากซีไอโอ</a></li>
                        <li><a class="dropdown-item" href="#">ติดต่อ ซีไอโอ</a></li>
                        <li><a class="dropdown-item" href="#">ปฎิทินกิจกรรมซีไอโอ</a></li>
                        <li><a class="dropdown-item" href="#">แผน/นโยบาย/ระเบียบ/คำสั่ง ที่เกี่ยวข้อง</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">จริยธรรมและป้องกันการทุจริต</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">การจัดการเรื่องร้องเรียนการทุจริต</a></li>
                        <li><a class="dropdown-item" href="#">การประเมินความเสี่ยงเพื่อการป้องกันการทุจริต</a></li>
                        <li><a class="dropdown-item" href="#">การเสริมสร้างวัฒนธรรมองค์กร</a></li>
                        <li><a class="dropdown-item" href="#">แผนปฏิบัติการป้องกันการทุจริต</a></li>
                        <li><a class="dropdown-item" href="#">มาตรการส่งเสริมความโปร่งใสและป้องกันการทุจริต</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-item" href="#">เจตนารมณ์ของผู้บริหาร</a></li>
                <li><a class="dropdown-item" href="#">การบริหารและพัฒนาทรัพยากรบุคคล</a></li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">คุณธรรมและความโปร่งใส (ITA)</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">แผนการประเมินคุณธรรมและความโปร่งใสฯ</a></li>
                        <li><a class="dropdown-item" href="#">ผลการประเมินคุณธรรมและความโปร่งใสฯ</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">การบริหารและพัฒนาทรัพยากรบุคคล</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">นโยบายการบริหารทรัพยากรบุคคล</a></li>
                        <li><a class="dropdown-item" href="#">การดำเนินการตามนโยบายการบริหารทรัพยากรบุคคล</a></li>
                        <li><a class="dropdown-item" href="#">หลักเกณฑ์การบริหารและพัฒนาทรัพยากรบุคคล</a></li>
                        <li><a class="dropdown-item" href="#">รายงานผลการบริหารและพัฒนาทรัพยากรบุคคล</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ประชาสัมพันธ์
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('news') }}">ประชาสัมพันธ์</a></li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">ประกาศ</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">จัดซื้อจัดจ้าง</a></li>
                        <li><a class="dropdown-item" href="#">ประกาศราคากลาง</a></li>
                        <li><a class="dropdown-item" href="#">สรุปผลการจัดซื้อจัดจ้าง</a></li>
                        <li><a class="dropdown-item" href="#">รับสมัครงาน</a></li>
                        <li><a class="dropdown-item" href="#">หนังสือรับรองการขัดกัน</a></li>
                        <li><a class="dropdown-item" href="#">แผนการจัดซื้อจัดจ้าง</a></li>
                        <li><a class="dropdown-item" href="#">ขายทอดตลาด</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-item" href="#">พม.Connect</a></li>
                <li><a class="dropdown-item" href="#">การเปิดโอกาสให้เกิดการมีส่วนร่วม</a></li>
                <li><a class="dropdown-item" href="#">ศูนย์ข้อมูลข่าวสาร</a></li>
                <li><a class="dropdown-item" href="#">คู่มือการขอรับเงินสนับสนุนจากกองทุนส่งเสริมความเท่าเทียมระหว่างเพศ</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                บริการ
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">การร้องทุกข์ ร้องเรียน</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">ร้องทุกข์ ร้องเรียน</a></li>
                        <li><a class="dropdown-item" href="#">รายงานการจัดการข้อร้องเรียนฯ</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-item" href="#">ถาม - ตอบ</a></li>
                <li><a class="dropdown-item" href="{{ route('faq') }}">คำถามที่พบบ่อย</a></li>
                <li><a class="dropdown-item" href="#">ช่องทางรับฟังความคิดเห็น</a></li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">ลงทะเบียนออนไลน์</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">ลงทะเบียนสัมมนาออนไลน์</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-item" href="#">สมัครสมาชิก</a></li>
                <li><a class="dropdown-item" href="#">แนะนำการใช้งาน</a></li>
                <li><a class="dropdown-item" href="#">RSS Feed</a></li>
                <li><a class="dropdown-item" href="#">ใบสมัครเข้ารับการฝึกอบรมอาชีพในสถาบัน สำหรับศูนย์เรียนรู้ฯ</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                คลังความรู้
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">กฏหมาย/ระเบียบ/ข้อบังคับ</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">กฎหมายว่าด้วยการป้องกันและปราบปรามค้าประเวณี</a></li>
                        <li><a class="dropdown-item" href="#">กฎหมายว่าด้วยการฌาปนกิจสงเคราะห์</a></li>
                        <li><a class="dropdown-item" href="#">กฎหมายว่าด้วยการคุ้มครองผู้ถูกกระทำด้วยความรุนแรงในครอบครัว</a></li>
                        <li><a class="dropdown-item" href="#">กฎหมายว่าด้วยความเท่าเทียมระหว่างเพศ</a></li>
                        <li><a class="dropdown-item" href="#">กฎหมายว่าด้วยการส่งเสริมการพัฒนาและคุ้มครองสถาบันครอบครัว</a></li>
                        <li><a class="dropdown-item" href="#">พ.ร.ก.แก้ไขเพิ่มเติม พ.ร.บ.ส่งเสริมการพัฒนาและคุ้มครองสถาบันครอบครัวฯ</a></li>
                        <li><a class="dropdown-item" href="#">ระเบียบสำนักนายกรัฐมนตรี (สตรี)</a></li>
                        <li><a class="dropdown-item" href="#">ระเบียบสำนักนายกรัฐมนตรี (สถาบันครอบครัว)</a></li>
                        <li><a class="dropdown-item" href="#">ระเบียบกรมกิจการสตรีและสถาบันครอบครัว</a></li>
                        <li><a class="dropdown-item" href="#">กฎหมายว่าด้วยคำนำหน้านามหญิง</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">คู่มือ มาตรฐาน</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">คู่มือ มาตรฐาน การปฏิบัติงาน</a></li>
                        <li><a class="dropdown-item" href="#">คู่มือ มาตรฐาน การให้บริการ</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-item" href="#">ลองเรียน ลองรู้ สร้างอาชีพ</a></li>
                <li><a class="dropdown-item" href="#">นิยามศัพท์</a></li>
                <li><a class="dropdown-item" href="#">ดาวน์โหลดแบบฟอร์ม</a></li>
                <li><a class="dropdown-item" href="#">แนวทางพิจารณาโครงการขอรับเงินอุดหนุน สค.</a></li>
                <li><a class="dropdown-item" href="#">ข้อมูลด้านสตรี</a></li>
                <li><a class="dropdown-item" href="#">ข้อมูลด้านครอบครัว</a></li>
                <li><a class="dropdown-item" href="#">ระบบบริหารจัดการองค์ความรู้ (KM)</a></li>
                <li><a class="dropdown-item" href="#">เครือข่ายหญิงไทยในต่างประเทศ</a></li>
                <li><a class="dropdown-item" href="#">แหล่งเรียนรู้ด้านเทคโนโลยีสารสนเทศของ พม.</a></li>
                <li><a class="dropdown-item" href="#">ศูนย์ข้อมูลกลางด้านความเสมอภาคหญิงชาย</a></li>
                <li><a class="dropdown-item" href="#">งานวิจัย สค.</a></li>
                <li><a class="dropdown-item" href="#">องค์กรคุณธรรมและความโปร่งใส</a></li>
                <li><a class="dropdown-item" href="#">สมัชชาสตรีและครอบครัว</a></li>
                <li><a class="dropdown-item" href="#">คลังข้อมูลสารสนเทศ</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ระบบงาน สค.
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">ระบบอินทราเน็ต</a></li>
                <li><a class="dropdown-item" href="#">ระบบจดหมายอิเล็กทรอนิกส์</a></li>
                <li><a class="dropdown-item" href="#">ระบบศูนย์ปฏิบัติการ สค.</a></li>
                <li><a class="dropdown-item" href="#">ระบบประชุมทางไกล</a></li>
                <li><a class="dropdown-item" href="#">ตรวจสอบภายใน</a></li>
                <li><a class="dropdown-item" href="#">ระบบ DPIS</a></li>
                <li><a class="dropdown-item" href="#">สำหรับผู้นำเข้าข้อมูลเว็บไซต์</a></li>
                <li><a class="dropdown-item" href="#">เว็บไซต์ สค. เดิม</a></li>
                <li><a class="dropdown-item" href="#">ระบบ E-learning ความรุนแรงในครอบครัว และจัดการบัญหา</a></li>
                <li><a class="dropdown-item" href="#">ระบบจัดการเว็บไซต์ สำหรับศูนย์เรียนรู้ฯ</a></li>
                <li><a class="dropdown-item" href="#">ระบบฐานข้อมูลผู้รับบริการและผู้ประสบปัญหาทางสังคม สค. (เก่า)</a></li>
                <li><a class="dropdown-item" href="#">ใบสมัครเข้ารับการฝึกอบรมอาชีพในสถาบัน สำหรับศูนย์เรียนรู้ฯ (เก่า)</a></li>
                <li><a class="dropdown-item" href="#">ศูนย์ข้อมูลความรุนแรงต่อเด็ก สตรีและความรุนแรงในครอบครัว</a></li>
                <li><a class="dropdown-item" href="#">ระบบแผนงานโครงการและติดตามผล</a></li>
                <li><a class="dropdown-item" href="#">ระบบงานสารบรรณอิเล็กทรอนิกส์</a></li>
                <li><a class="dropdown-item" href="#">มาตรฐานครอบครัวเข้มแข็ง</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ข้อมูลสถิติ
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">สถานการณ์ความรุนแรงต่อเด็ก สตรีและความรุนแรงในครอบครัว</a></li>
                <li><a class="dropdown-item" href="#">สถานการณ์ ครอบครัวเข้มแข็ง</a></li>
                <li><a class="dropdown-item" href="#">สถานการณ์ หญิงชาย</a></li>
                <li><a class="dropdown-item" href="#">ข้อมูลด้านการฌาปนกิจสงเคราะห์</a></li>
                <li><a class="dropdown-item" href="#">สถานการณ์สตรีและครอบครัว</a></li>
                <li><a class="dropdown-item" href="#">ข้อมูลสถิติการให้บริการ</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                แผน-ผล
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">ยุทธศาสตร์</a></li>
                <li><a class="dropdown-item" href="#">Aแผนการดำเนินงาน</a></li>
                <li><a class="dropdown-item" href="#">แผนการใช้จ่ายงบประมาณประจำปี</a></li>
                <li><a class="dropdown-item" href="#">คำรับรองและรายงานผลการปฎิบัติราชการ</a></li>
                <li><a class="dropdown-item" href="#">รายงานผลการสำรวจความพึงพอใจการให้บริการ</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ติดต่อ สค.
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">ติดต่อ สค. (ส่วนกลาง)</a></li>
                <li><a class="dropdown-item" href="#">ติดต่อ สค. (ส่วนภูมิภาค)</a></li>
                <li><a class="dropdown-item" href="#">แผนผังเว็บไซต์</a></li>
                <li><a class="dropdown-item" href="#">สำหรับเจ้าหน้าที่</a></li>
                <li><a class="dropdown-item" href="#">ป๊อปอัพ</a></li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">ข้อมูลทั่วไป</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">ข้อตกลงการให้บริการ</a></li>
                        <li><a class="dropdown-item" href="#">นโยบายความเป็นส่วนตัว</a></li>
                    </ul>
                </li>
                <a class="dropdown-item" href="#">Social Network</a>
            </ul>
        </li> --}}

        <li class="nav-item border-bottom-0">
            {!! Form::open(['url'=>'search', 'id'=>'form-search', 'method'=>'get']) !!}
            <div class="form-search">
                <div class="position-relative">
                    <span class="ic-search"></span>
                    <input type="search" class="form-control" name="q" placeholder="ค้นหาข้อมูล">
                </div>
            </div>
            {!! Form::close() !!}
        </li>

        <li class="menu-mb"><a href="#">สมาชิก</a></li>
        <li class="menu-mb"><a href="{{ route('backend') }}" target="_blank">ADMIN</a></li>
        <li class="menu-mb"><a href="#">ร้องทุกข์-ร้องเรียน</a></li>
        <li class="menu-mb"><a href="#">INTRANET</a></li>
    </ul>
</nav>