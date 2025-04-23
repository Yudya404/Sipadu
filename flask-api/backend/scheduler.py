import os
import subprocess
import datetime

print(f"⏰ Retraining dimulai: {datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')}")

try:
    # Jalankan train_model.py (pastikan path-nya sesuai)
    result = subprocess.run(["python", "train_model.py"], check=True)
    print("✅ Retraining berhasil dilakukan!")
except subprocess.CalledProcessError as e:
    print(f"❌ Gagal melakukan retraining: {e}")
