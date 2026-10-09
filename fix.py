import os, glob

files = glob.glob('resources/pages/*.php')
files += ['resources/layouts/dashboard.php', 'resources/layouts/app.php', 'index.php']

for fpath in files:
    if os.path.exists(fpath):
        with open(fpath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Replacements
        content = content.replace('Milestone', 'Gate')
        content = content.replace('MILESTONE', 'GATE')
        content = content.replace('milestone', 'gate')
        content = content.replace('M01', 'G01')
        content = content.replace('M02', 'G02')
        content = content.replace('M03', 'G03')
        content = content.replace('M04', 'G04')
        
        with open(fpath, 'w', encoding='utf-8') as f:
            f.write(content)
