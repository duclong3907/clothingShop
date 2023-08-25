Hướng dẫn sử dụng project!!!
Sau khi clone về chạy 5 lệnh sau:
composer update
cp .env.example .env
php artisan migrate
php artisan db:seed
php artisan serve

Note: -không cần chạy php artisan key:generate.
-Chỉ tạo được tài khoản user nên chỉ ở trang customer do mặc định là quyền user.
-Muốn vào được trang admin thì vào database trong bảng user sửa cột usertype từ 2 thành 1.

