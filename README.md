# INSTALL Software

1. Composer
2. NodeJS
3. PHP
4. MySQl

# Set and Install Project

1. npm install
2. composer install

# Set Database and .env

    1. Create DB name => db_cryptocurrencies
    2. Set DB_USERNAME=root # Config device
    3. Set DB_PASSWORD= # Config device

# Step Run Project

    1. php artisan migrate
    2. php artisan db:seed --class=DatabaseSeeder
    3. php artisan serve
    4. Open link server started

# วิธีใช้งาน

    1. ดาวน์โหลดไฟล์ postman ที่อยู่ใน Folder Postman จะมี 2 ไฟล์ นำมา import เข้าไปใน postman ได้เลย
    2. import เรียบร้อยแล้วจะมี โฟร์เดอร์ชื่อว่า Cryptocurrencies System API ขึ้นมา
    3. ซึ่งในโฟร์เดอร์นี้จะมีแยกโฟร์เดอร์ย่อยๆอีก 4 โฟร์เดอร์ ซึ่งได้รวม api ที่ใช้ยิงใช้งานส่วนของระบบไว้หมดแล้ว
    4. ระบบหลักๆที่ได้ทำไว้จะมีดังนี้
        - ระบบ User
            การทำงานจะมี [ดึงข้อมูล user ทั้งหมดที่มี, ดึงข้อมูลกระเป๋า crypto ในระบบ, สร้าง User ใหม่ โดยจะมีการทำให้ผูกกระเป๋า crypto ที่เซ็ตไว้ในระบบให้เลย]
        - ระบบ Trade / Order
            การทำงานจะมี [ดึงข้อมูลออเดอร์ที่ยังเปิดให้ ซื้อ/ขาย อยู่จาก symbol crypto, ดึงข้อมูลออเดอร์ที่ เปิด/ปิด ทั้งหมด จาก User, สร้างอเดอร์ ซื้อ/ขาย ใหม่ ]
        - ระบบ Payment
            การทำงานจะมี [สร้างการชำระเงินในการซื้อ/ขาย crypto จากผู้ที่ต้องชำระเงินการการซื้อ/ขาย, ยืนยันการชำระเงินการซื้อ/ขาย crypto จากผู้ที่ต้องได้รับเงินจากการซื้อ/ขาย และได้ทำให้หลังจากการยืนยันการชำระเงินแล้ว ทำการเปิด Transfer Crypto ให้เองโดยอัตโนมัติ]
        - ระบบ Transfer Crypto
            การทำงานจะมี [สร้างการ Transfer crypto ใหม่โดยจะเป็นการฝาก/ถอน, ยืนยันการได้รับ crypto]
