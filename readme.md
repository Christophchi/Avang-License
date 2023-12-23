
---

# Avang Licenser

## Overview
Avang Licenser is a PHP library designed to enhance the security of PHP scripts by implementing a robust license system. It prevents unauthorized access and usage, making it suitable for protecting PHP scripts from script kiddies and clients to whom you distribute the scripts.

### Author
- Christopher Chibuike

### Installation
To use this script, download or require the package as the base of your project. Create a `welcome.php` file inside the folder, which will serve as your index file. You can organize your project assets in folders within the downloaded directory. Note that there's a default `index.php` file in the script that validates the license key from your issuing server before redirecting users to `welcome.php`.

### Setup Instructions
1. Open `.env` located in the root of your project and set:
    - `apikey`: Your API key obtained from your API server.
    - `apiserver`: The correct URL from which the script will fetch the license key.
    - `timezone` (optional): Set your desired timezone.
    - `app name` (optional): Modify the app name if needed.

2. Create a License Server:
    - Install Laravel or any backend service on a web hosting service.
    - Create a database with columns: `license_key`, `expiry_date`, `license_domain`.
    - Ensure the database columns match the conventions exactly as stated to avoid errors.
    - Connect a domain to the server, which will serve as your `apiserver`.

3. Usage:
    - Upload the project folder to any server supporting PHP^ 8.1.
    - Verify the license script in action by visiting the deployed project.

4. Advanced Encryption (Optional):
    - For more advanced encryption, consider encoding the `index.php` and `activate_inc.php` using IonCube Loader. You can encode these files [here](https://www.ioncube.com/main.php?c=encode).
    - Ensure IonCube Loader is available on your server if you choose to encode these files.

### Upcoming Features
- Future updates will include improved domain validation and multiple API keys for clients.

### Support and Bug Fixes
For bug fixes or support, contact [support@codedwebltd.org](mailto:support@codedwebltd.org) or open a pull request following best practices for easy merging.

### Acknowledgment
If this script helped you, consider supporting the author by [buying a coffee](https://christopher.codedwebltd.org/#contacts-card). Feel free to contact me for preferred payment info using the link above..

---