# 🤝 Contributing to M-Pesa Integration Ecosystem

First off, welcome! Thank you for taking the time to contribute and help make M-Pesa integration simple for beginners. 

To maintain a clean code architecture and ensure everyone can learn effectively, please follow this step-by-step workflow when submitting modifications, bug fixes, or documentation enhancements.

---

## 🛠️ Step-by-Step Pull Request (PR) Workflow

### 1. Fork the Repository
Do not try to push changes directly to the `main` branch of this repository. Instead, look at the top right corner of this GitHub page and click the **Fork** button. This creates a personal copy of the codebase under your own GitHub profile.

### 2. Clone Your Fork Locally
Open your terminal application and clone your newly forked copy onto your development computer:
```bash
git clone https://github.com
cd Mpesa-intergration-using-php
```

### 3. Create a Dedicated Feature Branch
Never work directly on your local `main` branch. Create a descriptive, isolated branch for your task:
```bash
git checkout -b feature/add-xampp-docs
# OR for bug fixes:
git checkout -b fix/stk-phone-formatting
```

### 4. Code & Commit with Clear Messages
Make your modifications inside your text editor. Ensure your code is thoroughly commented so beginners can understand *why* you wrote a line a certain way. Stage and commit your changes with clear messages:
```bash
git add .
git commit -m "docs: add comprehensive troubleshooting steps for XAMPP server environments"
```

### 5. Push to Your Fork
Push your temporary workspace branch up to your personal profile copy on GitHub:
```bash
git push origin feature/add-xampp-docs
```

### 6. Submit Your Pull Request
1. Return to the main page of **this original repository** on GitHub.
2. You will see a prominent yellow banner that says **"Compare & pull request"**. Click it!
3. Give your PR a concise title and describe exactly what problem your code fixes or what new feature it introduces.
4. Click **Create pull request**.

---

## 🛑 Contribution Ground Rules

To keep things ultra-simple for new developers in town, all submissions must respect these core guidelines:

* **Zero Frame-Work Dependencies:** Do not add external frameworks, routers, or composers unless absolutely necessary. Keep the code pure, native PHP using `cURL` and standard PDO.
* **Aggressive Commenting:** If you introduce an optimization, add an inline comment explaining it. If a beginner can't read it, it won't be merged.
* **Never Leak Secrets:** Double-check your code before committing to ensure you have not accidentally typed your real Safaricom Daraja Production Keys or live MySQL passwords into the files. Use placeholder text.
