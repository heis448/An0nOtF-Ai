#An0nOtF Technologies Inc 💎 
#Coded by Tylor 😃Kenya Kasongo Civilian 🇰🇪 
#Jibambe 

import requests
import time
import json
import random
import string
import sys
import os
from datetime import datetime


class Colors:
    RED = '\033[91m'
    GREEN = '\033[92m'
    YELLOW = '\033[93m'
    BLUE = '\033[94m'
    MAGENTA = '\033[95m'
    CYAN = '\033[96m'
    WHITE = '\033[97m'
    BOLD = '\033[1m'
    RESET = '\033[0m'
    ORANGE = '\033[38;5;208m'
    PINK = '\033[38;5;213m'
    PURPLE = '\033[38;5;129m'
    LIME = '\033[38;5;118m'
    GOLD = '\033[38;5;220m'

c = Colors()


def clear():
    os.system('cls' if os.name == 'nt' else 'clear')


def show_banner():
    banner = f'''
{c.CYAN}{c.BOLD}
╔═══════════════════════════════════════════════════════════════════════════╗
║                                                                           ║
║  {c.GOLD}   ██████╗██╗      █████╗ ██╗██╗      █████╗      █████╗ ██╗{c.CYAN}            ║
║  {c.GOLD}  ██╔════╝██║     ██╔══██╗██║██║     ██╔══██╗    ██╔══██╗██║{c.CYAN}            ║
║  {c.GOLD}  ██║     ██║     ███████║██║██║     ███████║    ███████║██║{c.CYAN}            ║
║  {c.GOLD}  ██║     ██║     ██╔══██║██║██║     ██╔══██║    ██╔══██║██║{c.CYAN}            ║
║  {c.GOLD}  ╚██████╗███████╗██║  ██║██║███████╗██║  ██║    ██║  ██║██║{c.CYAN}            ║
║  {c.GOLD}   ╚═════╝╚══════╝╚═╝  ╚═╝╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚═╝{c.CYAN}            ║
║                                                                           ║
║  {c.MAGENTA}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━{c.CYAN}  ║
║  {c.WHITE}  🚀 UNLIMITED AI BYPASS TOOL ~ An0nOtF Technologies Inc 💎 🚀{c.CYAN}                            ║
║  {c.MAGENTA}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━{c.CYAN}  ║
║                                                                           ║
║  {c.GREEN}[✓]{c.WHITE} Version    : {c.LIME}2.0 PRO{c.CYAN}                                            ║
║  {c.GREEN}[✓]{c.WHITE} Developer  : {c.GOLD}@unknownnumeralx{c.CYAN}                                         ║
║  {c.GREEN}[✓]{c.WHITE} Status     : {c.LIME}ACTIVE & WORKING{c.CYAN}                                   ║
║  {c.GREEN}[✓]{c.WHITE} Model      : {c.LIME}GPT-5-MINI{c.CYAN}                                         ║
║                                                                           ║
╚═══════════════════════════════════════════════════════════════════════════╝
{c.RESET}'''
    print(banner)


def loading_animation(text, duration=1.5):
    frames = ["⠋", "⠙", "⠹", "⠸", "⠼", "⠴", "⠦", "⠧", "⠇", "⠏"]
    end_time = time.time() + duration
    i = 0
    while time.time() < end_time:
        sys.stdout.write(f'\r  {c.CYAN}{frames[i % len(frames)]} {c.WHITE}{text}{c.RESET}')
        sys.stdout.flush()
        time.sleep(0.1)
        i += 1
    sys.stdout.write('\r' + ' ' * 60 + '\r')
    sys.stdout.flush()

def progress_bar(text, duration=1.0):
    bar_length = 30
    for i in range(bar_length + 1):
        percent = int((i / bar_length) * 100)
        filled = "█" * i
        empty = "░" * (bar_length - i)
        
        if percent < 33:
            color = c.RED
        elif percent < 66:
            color = c.YELLOW
        else:
            color = c.GREEN
            
        sys.stdout.write(f'\r  {c.CYAN}[{color}{filled}{c.WHITE}{empty}{c.CYAN}] {c.GOLD}{percent}%{c.WHITE} {text}{c.RESET}')
        sys.stdout.flush()
        time.sleep(duration / bar_length)
    print()

def rand_string(n=16):
    return ''.join(random.choice(string.ascii_letters + string.digits) for _ in range(n))

def rand_useragent():
    versions = ["124.0.0.0", "125.0.0.0", "126.0.0.0", "127.0.0.0", "128.0.0.0", "129.0.0.0", "130.0.0.0"]
    platforms = [
        f"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{random.choice(versions)} Mobile Safari/537.36",
        f"Mozilla/5.0 (Linux; Android 11; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{random.choice(versions)} Mobile Safari/537.36",
        f"Mozilla/5.0 (Linux; Android 12; Pixel 6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{random.choice(versions)} Mobile Safari/537.36",
        f"Mozilla/5.0 (Linux; Android 13; SM-S918B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/{random.choice(versions)} Mobile Safari/537.36",
    ]
    return random.choice(platforms)

# ------------------ BY An0nOtF Technologies Inc 💎 ------------------

def generate_cookies():
    return {
        'dmcfkjn3cdc': rand_string(32),
        '_ga': f"GA1.1.{random.randint(100000,999999)}.{random.randint(1000000000,1999999999)}",
        '_gid': f"GA1.1.{random.randint(100000000,999999999)}.{int(time.time())}",
        'theme': 'dark',
        'lang': 'en',
        'auh': rand_string(8),
        'session_id': rand_string(24),
    }

def generate_headers():
    return {
        'authority': 'app.claila.com',
        'accept': '*/*',
        'accept-language': 'en-US,en;q=0.9',
        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'origin': 'https://app.claila.com',
        'referer': 'https://app.claila.com/chat?uid=' + rand_string(8) + '&lang=en',
        'user-agent': rand_useragent(),
        'x-requested-with': 'XMLHttpRequest',
    }

API_TOKEN = "https://app.claila.com/api/v2/getcsrftoken"
API_CHAT = "https://app.claila.com/api/v2/unichat4"

# ------------------ BY An0nOtF Technologies Inc 💎 ------------------

def status_box(title, items):
    width = 52
    print(f"\n{c.CYAN}╭{'─' * width}╮{c.RESET}")
    print(f"{c.CYAN}│{c.GOLD}{c.BOLD}{title.center(width)}{c.CYAN}│{c.RESET}")
    print(f"{c.CYAN}├{'─' * width}┤{c.RESET}")
    for key, value, status in items:
        status_icon = f"{c.GREEN}✓{c.RESET}" if status else f"{c.RED}✗{c.RESET}"
        text = f"{key}: {value}"
        if len(text) > width - 4:
            text = text[:width - 7] + "..."
        print(f"{c.CYAN}│ {status_icon} {c.WHITE}{text:<{width - 4}}{c.CYAN}│{c.RESET}")
    print(f"{c.CYAN}╰{'─' * width}╯{c.RESET}")

# ------------------ BY An0nOtF Technologies Inc 💎 ------------------

def get_token(cookies, headers):
    try:
        r = requests.get(API_TOKEN, cookies=cookies, headers=headers, timeout=10)
        return r.text.strip()
    except:
        return None

def send_message(msg):
    cookies = generate_cookies()
    headers = generate_headers()
    
    # Status Box
    spoof_items = [
        ("Session ID", cookies.get('session_id', 'N/A'), True),
        ("User-Agent", headers.get('user-agent', 'N/A'), True),
        ("Cookie Set", "Generated Successfully", True),
    ]
    status_box("🔐 SESSION SPOOFING", spoof_items)
    
    # Get Token
    print()
    progress_bar("Fetching CSRF Token...", 0.8)
    csrf = get_token(cookies, headers)
    
    if not csrf:
        return "❌ Token Fetch Failed. Please try again."
    
    print(f"  {c.GREEN}✓{c.WHITE} CSRF Token: {c.LIME}{csrf[:30]}...{c.RESET}")
    
    headers["x-csrf-token"] = csrf

    # Add English instruction to message
    full_message = f"[RESPOND IN ENGLISH ONLY] {msg}"

    data = {
        'model': 'gpt-5-mini',
        'calltype': 'completion',
        'message': full_message,
        'sessionId': rand_string(12),
        'chat_mode': 'chat',
        'websearch': 'false',
        'tmp_enabled': '0',
        'lang': 'en',
        'language': 'english',
    }

    print()
    progress_bar("Sending to AI Server...", 0.6)
    loading_animation("Processing Response...", 1.0)
    
    try:
        resp = requests.post(API_CHAT, cookies=cookies, headers=headers, data=data, timeout=30)
        
        # API returns plain text, not JSON!
        return resp.text.strip()
            
    except requests.exceptions.Timeout:
        return "❌ Request Timeout. Server is slow."
    except Exception as e:
        return f"❌ Error: {str(e)}"

# ------------------ RESPONSE BOX ------------------

def ai_response_box(response):
    width = 70
    
    print(f"\n{c.MAGENTA}╔{'═' * width}╗{c.RESET}")
    print(f"{c.MAGENTA}║{c.CYAN}{c.BOLD}{'🤖 AI RESPONSE'.center(width)}{c.MAGENTA}║{c.RESET}")
    print(f"{c.MAGENTA}╠{'═' * width}╣{c.RESET}")
    
    # Word wrap
    words = response.split()
    lines = []
    current_line = ""
    
    for word in words:
        if len(current_line) + len(word) + 1 <= width - 4:
            current_line += (" " if current_line else "") + word
        else:
            if current_line:
                lines.append(current_line)
            current_line = word
    if current_line:
        lines.append(current_line)
    
    if not lines:
        lines = ["No response received."]
    
    for line in lines:
        print(f"{c.MAGENTA}║  {c.WHITE}{line:<{width - 4}}{c.MAGENTA}║{c.RESET}")
    
    print(f"{c.MAGENTA}╚{'═' * width}╝{c.RESET}")

# ------------------ MENU FUNCTIONS ------------------

def show_menu():
    print(f'''
{c.CYAN}╭────────────────────────────────────────────╮
│{c.GOLD}{c.BOLD}            📋 COMMANDS MENU 📋             {c.CYAN}│
├────────────────────────────────────────────┤
│ {c.GREEN}/help    {c.WHITE}- Show this menu                 {c.CYAN}│
│ {c.GREEN}/clear   {c.WHITE}- Clear screen                   {c.CYAN}│
│ {c.GREEN}/status  {c.WHITE}- Check connection               {c.CYAN}│
│ {c.GREEN}/about   {c.WHITE}- About this tool                {c.CYAN}│
│ {c.GREEN}/exit    {c.WHITE}- Exit the program               {c.CYAN}│
╰────────────────────────────────────────────╯{c.RESET}
''')

def show_about():
    print(f'''
{c.MAGENTA}╭────────────────────────────────────────────╮
│{c.GOLD}{c.BOLD}            ℹ️  ABOUT THIS TOOL ℹ️            {c.MAGENTA}│
├────────────────────────────────────────────┤
│  {c.WHITE}Tool Name  : {c.CYAN}Claila AI Bypass Pro{c.MAGENTA}        │
│  {c.WHITE}Version    : {c.CYAN}2.0 FIXED{c.MAGENTA}                   │
│  {c.WHITE}Developer  : {c.GOLD}@unknownnumeralx{c.MAGENTA}                  │
│  {c.WHITE}Language   : {c.CYAN}Python 3{c.MAGENTA}                     │
│  {c.WHITE}Purpose    : {c.CYAN}Unlimited AI Chat{c.MAGENTA}            │
│                                            │
│  {c.YELLOW}Not For Educational Purposes ⚠️ {c.MAGENTA}              │
╰────────────────────────────────────────────╯{c.RESET}
''')

def show_status():
    print(f"\n  {c.CYAN}Checking connection...{c.RESET}")
    try:
        test = requests.get("https://app.claila.com", timeout=5)
        status = test.status_code == 200
    except:
        status = False
    
    status_text = f"{c.GREEN}ONLINE ✓{c.RESET}" if status else f"{c.RED}OFFLINE ✗{c.RESET}"
    
    print(f'''
{c.CYAN}╭────────────────────────────────────────────╮
│{c.GOLD}{c.BOLD}          📡 CONNECTION STATUS 📡           {c.CYAN}│
├────────────────────────────────────────────┤
│  {c.WHITE}Server     : {c.LIME}app.claila.com{c.CYAN}               │
│  {c.WHITE}Status     : {status_text}{c.CYAN}                       │
│  {c.WHITE}Time       : {c.LIME}{datetime.now().strftime("%Y-%m-%d %H:%M:%S")}{c.CYAN}      │
╰────────────────────────────────────────────╯{c.RESET}
''')

# ------------------ STARTUP ------------------

def startup_animation():
    clear()
    steps = [
        "Initializing System...",
        "Loading Modules...",
        "Connecting Server...",
        "Bypass Activated...",
        "Ready!"
    ]
    
    print(f"\n{c.CYAN}{'═' * 50}{c.RESET}")
    print(f"{c.GOLD}{c.BOLD}  🚀 CLAILA AI BYPASS - Starting...{c.RESET}")
    print(f"{c.CYAN}{'═' * 50}{c.RESET}\n")
    
    for step in steps:
        loading_animation(step, 0.4)
        print(f"  {c.GREEN}✓{c.WHITE} {step}{c.RESET}")
    
    print(f"\n{c.CYAN}{'═' * 50}{c.RESET}")
    time.sleep(0.5)

# ==================== COMMAND LINE SUPPORT ====================

def send_message_simple(msg):
    """Simplified version for command-line use"""
    try:
        cookies = generate_cookies()
        headers = generate_headers()
        
        csrf = get_token(cookies, headers)
        if not csrf:
            return "❌ Failed to get CSRF token"
        
        headers["x-csrf-token"] = csrf
        full_message = f"[RESPOND IN ENGLISH ONLY] {msg}"
        
        data = {
            'model': 'gpt-5-mini',
            'calltype': 'completion',
            'message': full_message,
            'sessionId': rand_string(12),
            'chat_mode': 'chat',
            'websearch': 'false',
            'tmp_enabled': '0',
            'lang': 'en',
            'language': 'english',
        }
        
        resp = requests.post(API_CHAT, cookies=cookies, headers=headers, data=data, timeout=30)
        
        # API returns plain text
        return resp.text.strip()
        
    except Exception as e:
        return f"❌ Error: {str(e)}"

# ------------------ MAIN ------------------

def main():
    startup_animation()
    clear()
    show_banner()
    
    print(f"\n{c.YELLOW}💡 Type {c.GREEN}/help{c.YELLOW} for commands | {c.GREEN}/exit{c.YELLOW} to quit{c.RESET}")
    print(f"{c.CYAN}{'━' * 60}{c.RESET}\n")
    
    msg_count = 0
    
    while True:
        try:
            # Input
            print(f"{c.CYAN}┌{'─' * 55}┐{c.RESET}")
            user = input(f"{c.CYAN}│ {c.GOLD}👤 You ➤ {c.WHITE}")
            print(f"{c.CYAN}└{'─' * 55}┘{c.RESET}")
            
            if not user.strip():
                print(f"\n{c.YELLOW}⚠️  Please enter a message.{c.RESET}\n")
                continue
            
            # Commands
            cmd = user.lower().strip()
            
            if cmd in ["/exit", "/quit", "exit", "quit"]:
                print(f"\n{c.GOLD}{'═' * 55}{c.RESET}")
                print(f"{c.CYAN}  👋 Thank you for using Claila AI Bypass!{c.RESET}")
                print(f"{c.MAGENTA}  🔥 Made with ❤️  by {c.GOLD}@unknownnumeralx{c.RESET}")
                print(f"{c.GOLD}{'═' * 55}{c.RESET}\n")
                break
                
            elif cmd == "/help":
                show_menu()
                continue
                
            elif cmd == "/clear":
                clear()
                show_banner()
                print(f"\n{c.GREEN}✓ Screen Cleared!{c.RESET}\n")
                continue
                
            elif cmd == "/status":
                show_status()
                continue
                
            elif cmd == "/about":
                show_about()
                continue
            
            # Send Message
            msg_count += 1
            print(f"\n{c.CYAN}📨 Message #{msg_count} | {datetime.now().strftime('%H:%M:%S')}{c.RESET}")
            
            reply = send_message(user)
            ai_response_box(reply)
            
            print(f"\n{c.CYAN}{'━' * 60}{c.RESET}\n")
            
        except KeyboardInterrupt:
            print(f"\n\n{c.YELLOW}⚠️  Interrupted!{c.RESET}")
            print(f"{c.CYAN}👋 Goodbye! - {c.GOLD}@unknownnumeralx{c.RESET}\n")
            break
        except Exception as e:
            print(f"\n{c.RED}❌ Error: {str(e)}{c.RESET}\n")
            continue

# ==================== COMMAND LINE HANDLER ====================

# Check if --query argument is provided
if len(sys.argv) > 2 and sys.argv[1] == "--query":
    query = " ".join(sys.argv[2:])
    response = send_message_simple(query)
    
    # Clean the response (remove color codes if any)
    import re
    clean_response = re.sub(r'\x1B\[[0-9;]*[A-Za-z]', '', response)
    print(clean_response)
    sys.exit(0)

# ---BY An0nOtF Technologies Inc 💎 -----

if __name__ == "__main__":
    try:
        main()
    except Exception as e:
        print(f"\n{c.RED}Fatal Error: {str(e)}{c.RESET}")
        print(f"{c.YELLOW}Report to {c.GOLD}@unknownnumeralx{c.RESET}\n")