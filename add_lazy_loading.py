import re

# Read the file
with open(r'c:\xampp\htdocs\Work\lesson.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Count images before
img_count = len(re.findall(r'<img', content))
print(f"Total images found: {img_count}")

# Add loading="lazy" and decoding="async" to all img tags that don't already have them
# Pattern: find <img tags that don't have loading= attribute
content = re.sub(
    r'(<img\s+[^>]*?)(?<!loading=")(\s*>)',
    lambda m: m.group(1) + ' loading="lazy" decoding="async"' + m.group(2) if 'loading=' not in m.group(0) else m.group(0),
    content
)

# Write back
with open(r'c:\xampp\htdocs\Work\lesson.html', 'w', encoding='utf-8') as f:
    f.write(content)

print("Successfully added loading='lazy' and decoding='async' to all images!")
