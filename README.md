## Larvel 12 Web push notification example using user

## Installing

Follow these steps to set up a development environment:

1. **Clone the repository**

    ```bash
    gitclone https://github.com/RekhaPatel6213/web-push-notification.git
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

    ```bash
    npm install
    ```

3. **Duplicate the .env.example file and rename it to .env**

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key**

    ```bash
    php artisan key:generate
    ```

5. **Run migration and seed**

    ```bash
    php artisan migrate --seed
    ```

6. **Run the application**

    ```bash
    npm run dev
    ```

    ```bash
    php artisan serve
    ```
## FireBase Setting Details


    Go to Firebase Console - Google (https://console.firebase.google.com)

    Create New Project

    Click on Gear icon -> Project settings -> General. Scroll down and goto Your Apps -> Web apps Section. Now copy firebaseConfig and replace in firebase_config.blade.php file.

    Now Click on Cloud Messaging tab. Scroll down and got to Web configuration -> Web Push certificates Section. Now copy Key pair and replace with "your-vapid-key" in firebase_config.blade.php file

    Now Click on Service Acounts tab. In Firebase Admin SDK Section click on " Generate new private key " button and one json file downloaded. Change that file name with "service-account.json" and put in storage/app/firebase folder.