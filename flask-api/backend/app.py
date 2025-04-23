from flask import Flask, request, jsonify
import pickle
from flask_cors import CORS

app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": ["http://127.0.0.1:5000", "http://localhost:8000"]}})

# 🔥 Load Model & Vectorizer & Label Encoder
MODEL_XGB_PATH = "model/model_xgboost.pkl"
MODEL_LGBM_PATH = "model/model_lightgbm.pkl"
VECTORIZER_PATH = "model/tfidf_vectorizer.pkl"
ENCODER_PATH = "model/label_encoder.pkl"

try:
    model_xgb = pickle.load(open(MODEL_XGB_PATH, "rb"))
    model_lgbm = pickle.load(open(MODEL_LGBM_PATH, "rb"))
    vectorizer = pickle.load(open(VECTORIZER_PATH, "rb"))
    label_encoder = pickle.load(open(ENCODER_PATH, "rb"))
    print("✅ Semua model berhasil dimuat!")
except Exception as e:
    print(f"❌ Gagal memuat model atau file pendukung: {e}")

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.json
        print("✅ Data diterima:", data)

        if "judul" not in data or "isi" not in data:
            return jsonify({"error": "Judul dan isi laporan diperlukan!"}), 400

        teks_laporan = f"{data['judul'].strip().lower()} {data['isi'].strip().lower()}"
        teks_vectorized = vectorizer.transform([teks_laporan])

        # 🔥 Gunakan XGBoost (default)
        pred = model_xgb.predict(teks_vectorized)[0]
        kategori = label_encoder.inverse_transform([pred])[0]

        response = {
            "status": "success",
            "kategori": kategori
        }
        print("✅ Response ke Laravel:", response)
        return jsonify(response), 200

    except Exception as e:
        print(f"❌ Terjadi kesalahan: {e}")
        return jsonify({"error": "Terjadi kesalahan di server!", "detail": str(e)}), 500

if __name__ == '__main__':
    app.run(host="0.0.0.0", port=5000, debug=True)