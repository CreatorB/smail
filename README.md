### Syathiby Mail (Smail) - Simplify Webmail Sign-Up Service

[![creatorbe on YouTube](https://raw.githubusercontent.com/CreatorB/smail/main/screenshot_syathiby_mail.png?token=GHSAT0AAAAAACSLXCJDBYZVA7BSSU33AOXYZXDTZYA)](https://raw.githubusercontent.com/CreatorB/smail/main/screenshot_syathiby_mail.png?token=GHSAT0AAAAAACSLXCJDBYZVA7BSSU33AOXYZXDTZYA "Syathiby Mail")

**Syathiby Mail (Smail)** is an innovative and user-friendly webmail sign-up service designed to streamline the creation of new email accounts. This platform leverages the CPANEL API to simplify the registration process and ensures that all new accounts undergo a thorough verification and management process by administrators.

#### Key Features:

1. **Simplified Sign-Up Process**:
   - **Intuitive Interface**: Our straightforward sign-up process allows users to create new email accounts quickly and easily.
   - **CPANEL API Integration**: Utilizes CPANEL API to automate and simplify the email account creation process.

2. **Administrative Oversight**:
   - **Admin Confirmation**: All new accounts require approval from an administrator, ensuring that only verified and legitimate users gain access to the system.
   - **Role-Based Access**: Administrators have the ability to manage user roles, granting or revoking access based on predefined criteria.

3. **Customizable and Scalable**:
   - **Environment Configuration**: Easily configurable environment variables allow for seamless deployment across different environments (development, staging, production).
   - **Database Management**: Flexible database configuration options support both local and production environments, ensuring smooth operation regardless of the deployment context.

4. **User-Friendly Experience**:
   - **Responsive Design**: A responsive and mobile-friendly design ensures that users can access and manage their accounts from any device ( _currently only impelementation on sign up page : gmail like us_ ).
   - **Clear Instructions**: Detailed instructions and tooltips guide users through the sign-up process, reducing the likelihood of errors and improving overall user satisfaction.

#### Getting Started:

To get started with Syathiby Mail, follow these steps:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/CreatorB/smail.git
   cd smail
   ```

2. **Configure Environment Variables**:
   - Update the `inc/.env` file with your CPANEL credentials and other necessary configurations.

3. **Run the Application**:
   ```bash
   php -S localhost:8000
   ```
   
   Open your browser and navigate to `http://localhost:8000`.

#### Database Setup:

To set up the database, create a new database and import the following SQL query to create the `users` table:

```sql
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    wa VARCHAR(20) DEFAULT NULL,
    role ENUM('santri_ikhwan', 'santri_akhwat', 'staff', 'admin_ikhwan', 'admin_akhwat', 'root') NOT NULL DEFAULT 'santri_ikhwan',
    is_confirmed INT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

#### Environment Configuration:

Edit the `.env` file located in the `inc` folder with the following configurations:

```env
ENVIRONMENT=development/production
BASE_DOMAIN=
HOSTNAME_SERVER=https://subdomain.${BASE_DOMAIN}
HOSTNAME_LOCAL=http://192.168.50.100/dev/smail
CPANEL_HOST=cpanel.${BASE_DOMAIN}
CPANEL_USERNAME=
CPANEL_PASSWORD=
CPANEL_PORT=
ERROR_LOG_PATH=../assets/error_log.txt
URL_OFFICIAL=https://${BASE_DOMAIN}
TIMEOUT=10
PATH_ROOT_CSS=${HOSTNAME_SERVER}/assets/css
PATH_ROOT_JS=${HOSTNAME_SERVER}/assets/js
PATH_ROOT_CSS_CREATORBE=${PATH_ROOT_CSS}/creatorbe.css
PATH_ROOT_JS_CREATORBE=${PATH_ROOT_JS}/creatorbe.js
NAMESERVER=localhost
USERNAME_PROD=
PASSWORD_PROD=
NAMADB_PROD=
USERNAME_LOCAL=root
PASSWORD_LOCAL=
NAMADB_LOCAL=smail
```

#### Contributing:

We welcome contributions from the community to help improve Syathiby Mail. To contribute, please follow these steps:

1. **Fork the Repository**:
   - Click the "Fork" button at the top right of the repository page.

2. **Clone Your Fork**:
   ```bash
   git clone https://github.com/yourusername/smail.git
   cd smail
   ```

3. **Create a New Branch**:
   ```bash
   git checkout -b feature/your-feature-name
   ```

4. **Make Your Changes**:
   - Implement your feature or bug fix.
   - Ensure that your code follows the project's coding standards.

5. **Commit Your Changes**:
   ```bash
   git commit -m "Add your commit message here"
   ```

6. **Push to Your Fork**:
   ```bash
   git push origin feature/your-feature-name
   ```

7. **Create a Pull Request**:
   - Go to the original repository and click the "New Pull Request" button.
   - Select your branch and submit the pull request.

#### Code of Conduct:

Please note that we will create a [Changelog](CHANGELOG.md) in place to ensure a positive and inclusive environment all your interactions and update with the project.

#### License:

Syathiby Mail is open-source software licensed under the [MIT License](LICENSE.md).

---

Join us in revolutionizing the way users interact with Syathiby's webmail service. Experience the future of email management with Syathiby Mail.

---
