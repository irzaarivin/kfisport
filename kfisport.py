import subprocess
import os

# Menjalankan XAMPP MySQL
subprocess.Popen("C:\\xampp\\mysql_start.bat")

# Mengarahkan ke direktori aplikasi
app_dir = 'c:/Applications/kfisport'
os.chdir(app_dir)

# Menjalankan perintah 'php artisan serve' di Git Bash
subprocess.Popen(["C:\\Program Files\\Git\\git-bash.exe", "--command=php artisan serve"])

# Menjalankan perintah 'npm run dev' di Git Bash
subprocess.Popen(["C:\\Program Files\\Git\\git-bash.exe", "--command=npm run dev"])