# TLDR Spotify - Music Discovery & Analytics Platform

A comprehensive Spotify integration web application that provides personalized weekly music breakdowns, artist news, and intelligent music recommendations based on your listening habits.

## 🎵 Overview

TLDR Spotify analyzes your Spotify listening data to deliver curated weekly reports featuring your favorite artists, new music recommendations, upcoming concerts, and personalized insights. Stay connected with your music taste and discover new tracks that match your preferences.

## ✨ Features

- **Weekly Music Reports**: Receive detailed email summaries of your Spotify activity
- **Personalized Recommendations**: AI-driven song suggestions based on your listening patterns  
- **Artist News & Updates**: Stay informed about your favorite artists' latest releases and news
- **Top Tracks Analysis**: Detailed breakdown of your most played songs and artists
- **Concert Notifications**: Get notified about upcoming shows from artists you love
- **Spotify OAuth Integration**: Secure authentication through Spotify's official API
- **User Dashboard**: Web-based interface to view your music statistics and manage preferences

## 🛠️ Technology Stack

### Frontend
- **HTML5** with semantic markup
- **CSS3** with custom styling
- **Bootstrap 4.3.1** for responsive design
- **jQuery 3.3.1** for interactive elements
- **Ionic Icons** for visual elements

### Backend
- **PHP** for server-side logic and web pages
- **Python** for Spotify API token management and data processing
- **MySQL** for user data and authentication storage

### APIs & Services
- **Spotify Web API** for music data and authentication
- **Email Services** for weekly report delivery

## 📁 Project Structure

```
TLDR/
├── .dev/                    # Main development files
│   ├── index.php           # Homepage and landing page
│   ├── auth.php            # Spotify authentication handler
│   ├── signup.php          # User registration
│   ├── login.php           # User login
│   ├── top50.php           # Top tracks functionality
│   ├── tokenManager.py     # Python token management
│   └── *.css               # Styling files
├── archive/                # Archived versions of files
└── README.md              # Project documentation
```

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- Python 3.7 or higher  
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Spotify Developer Account

### 1. Clone the Repository
```bash
git clone https://github.com/markgraham924/TLDR.git
cd TLDR
```

### 2. Database Setup
1. Create a MySQL database named `spotifyData`
2. Set up the required tables:
   - `userCode` - Store user authorization codes
   - `userToken` - Store Spotify access tokens
   - Additional tables as needed for user data

### 3. Spotify API Configuration
1. Create a Spotify app at [Spotify Developer Dashboard](https://developer.spotify.com/dashboard)
2. Note your `Client ID` and `Client Secret`
3. Set redirect URI to: `https://yourdomain.com/signup.php`
4. Update the credentials in `tokenManager.py`

### 4. Python Dependencies
```bash
pip install requests mysql-connector-python
```

### 5. Web Server Configuration
- Point your web server to serve files from the `.dev/` directory
- Ensure PHP is properly configured with MySQL extensions
- Set up SSL certificate for HTTPS (required for Spotify OAuth)

## 📖 Usage

### For Users
1. Visit the application homepage
2. Click "Signup" to authenticate with Spotify
3. Grant necessary permissions for music data access
4. Receive your first weekly report via email
5. Access your dashboard to view detailed analytics

### For Developers
- Main application files are in `.dev/` directory
- `tokenManager.py` handles Spotify token refresh and management
- PHP files handle web interface and user interactions
- Database connection settings are in `tokenManager.py`

## 🔧 Development

### Running Locally
1. Set up a local web server with PHP support
2. Configure MySQL database with appropriate credentials
3. Update API endpoints and database connections for local environment
4. Test Spotify OAuth flow with development credentials

### Token Management
The Python `tokenManager.py` script should be run periodically to:
- Refresh expired Spotify access tokens
- Update user authentication status
- Process weekly report generation

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📋 Project Management

- **GitHub Repository**: [markgraham924/TLDR](https://github.com/markgraham924/TLDR)
- **Project Board**: [Trello - TL;DL Spotify](https://trello.com/b/em1SQhK9/tl-dl-spotify)

## 👨‍💻 Author

**Mark Graham** - [Layered Network](https://gmpauto.co.uk)
- Twitter: [@MarkG924](https://twitter.com/MarkG924)
- Instagram: [@_mark.graham](https://www.instagram.com/_mark.graham/)

## 📄 License

This project is managed within the GMPAUTO.co.uk network as an asset of Layered Network.

Copyright © 2019 Mark Graham (Layered Network)

---

*Built with ❤️ for music lovers who want to understand their listening habits better.*
