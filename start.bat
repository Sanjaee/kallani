@echo off
REM Kallani - Development Server Startup Script

echo.
echo ========================================
echo KALLANI - Operating System for
echo Productive Natural Assets
echo ========================================
echo.
echo Starting development server...
echo.

cd /d "%~dp0"

REM Check if PHP is installed
php -v >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP is not installed or not in PATH
    echo Please install PHP 7.4+ or add it to your system PATH
    pause
    exit /b 1
)

echo PHP version:
php -v

echo.
echo Starting server on http://localhost:8000
echo Press Ctrl+C to stop the server
echo.

php -S localhost:8000 -t public

pause
