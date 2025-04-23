import pandas as pd
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import classification_report, confusion_matrix
from imblearn.over_sampling import SMOTE
import xgboost as xgb
import lightgbm as lgb
import pickle
import os

# 🔥 Path
MODEL_XGB_PATH = "model/model_xgboost.pkl"
MODEL_LGBM_PATH = "model/model_lightgbm.pkl"
VECTORIZER_PATH = "model/tfidf_vectorizer.pkl"
ENCODER_PATH = "model/label_encoder.pkl"
DATASET_PATH = "C:/xampp/htdocs/sipadu/flask-api/dataset/dataset_pengaduan.csv"

# 🔥 Load dataset
df = pd.read_csv(DATASET_PATH)

# Validasi kolom
if "judul" not in df.columns or "isi" not in df.columns:
    raise ValueError("Dataset harus memiliki kolom 'judul' dan 'isi'")
if "kategori" not in df.columns:
    raise ValueError("Kolom 'kategori' tidak ditemukan!")

# Gabungkan teks
df["teks_laporan"] = df["judul"].astype(str) + " " + df["isi"].astype(str)
df["teks_laporan"] = df["teks_laporan"].str.lower()

# Label standar
df["kategori"] = df["kategori"].apply(lambda x: "Asli" if x == "Asli" else "Spam")

# Encode label
label_encoder = LabelEncoder()
y = label_encoder.fit_transform(df["kategori"])

# TF-IDF vectorization
vectorizer = TfidfVectorizer(stop_words="english")
X = vectorizer.fit_transform(df["teks_laporan"])

# Split sebelum SMOTE
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, random_state=42, stratify=y
)

# ✅ Balancing data dengan SMOTE
smote = SMOTE(random_state=42)
X_train_bal, y_train_bal = smote.fit_resample(X_train, y_train)

print("✅ Balancing dengan SMOTE berhasil dilakukan!")
print("Jumlah data sebelum balancing:", len(y_train))
print("Jumlah data setelah balancing:", len(y_train_bal))

# 🔥 Train XGBoost
xgb_model = xgb.XGBClassifier(n_estimators=100, random_state=42, use_label_encoder=False, eval_metric='logloss')
xgb_model.fit(X_train_bal, y_train_bal)

# 🔥 Train LightGBM
lgbm_model = lgb.LGBMClassifier(n_estimators=100, random_state=42)
lgbm_model.fit(X_train_bal, y_train_bal)

# Evaluasi XGBoost
print("\n📈 Evaluasi Model XGBoost (Test Set):")
y_pred_xgb = xgb_model.predict(X_test)
print(confusion_matrix(y_test, y_pred_xgb))
print(classification_report(y_test, y_pred_xgb, target_names=label_encoder.classes_))

# Evaluasi LightGBM
print("\n📈 Evaluasi Model LightGBM (Test Set):")
y_pred_lgbm = lgbm_model.predict(X_test)
print(confusion_matrix(y_test, y_pred_lgbm))
print(classification_report(y_test, y_pred_lgbm, target_names=label_encoder.classes_))

# Simpan model dan lainnya
os.makedirs("model", exist_ok=True)
pickle.dump(xgb_model, open(MODEL_XGB_PATH, "wb"))
pickle.dump(lgbm_model, open(MODEL_LGBM_PATH, "wb"))
pickle.dump(vectorizer, open(VECTORIZER_PATH, "wb"))
pickle.dump(label_encoder, open(ENCODER_PATH, "wb"))

print("\n✅ Semua model dan file pendukung berhasil disimpan di folder 'model/'!")