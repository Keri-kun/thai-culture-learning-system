# -*- coding: utf-8 -*-
"""
Script to reorder district sections in lesson.html
Target order: เมือง, บ้านลาด, ท่ายาง, บ้านแหลม, เขาย้อย, ชะอำ, แก่งกระจาน, หนองหญ้าปล้อง
"""

import re

# Read the file
with open(r'c:\xampp\htdocs\Work\lesson.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Find the start and end of district sections
start_marker = '<!-- Category'
end_marker = '<!-- Section 2: Artisans Header'

# Find indices
start_idx = content.find('<!-- Category 4: อำเภอบ้านแหลม -->')
end_idx = content.find(end_marker)

if start_idx == -1 or end_idx == -1:
    print("Error: Could not find section markers")
    exit(1)

# Extract parts
before_sections = content[:start_idx]
after_sections = content[end_idx:]
district_content = content[start_idx:end_idx]

# Split into individual district sections
sections = {}
lines = district_content.split('\n')
current_district = None
current_content = []

for line in lines:
    if '<!-- Category' in line and 'อำเภอ' in line:
        # Save previous section
        if current_district:
            sections[current_district] = '\n'.join(current_content)
        
        # Determine which district
        if 'เมืองเพชรบุรี' in line:
            current_district = 'mueang'
        elif 'บ้านลาด' in line:
            current_district = 'ban_lat'
        elif 'ท่ายาง' in line:
            current_district = 'tha_yang'
        elif 'บ้านแหลม' in line:
            current_district = 'ban_laem'
        elif 'เขาย้อย' in line:
            current_district = 'khao_yoi'
        elif 'ชะอำ' in line:
            current_district = 'cha_am'
        elif 'แก่งกระจาน' in line:
            current_district = 'kaeng_krachan'
        elif 'หนองหญ้าปล้อง' in line:
            current_district = 'nong_ya_plong'
        
        current_content = [line]
    else:
        current_content.append(line)

# Save last section
if current_district:
    sections[current_district] = '\n'.join(current_content)

# New order
new_order = ['mueang', 'ban_lat', 'tha_yang', 'ban_laem', 'khao_yoi', 'cha_am', 'kaeng_krachan', 'nong_ya_plong']

# Rebuild with new order and updated category numbers
new_district_content = ''
for idx, district in enumerate(new_order, 1):
    if district in sections:
        section = sections[district]
        # Update category number
        section = re.sub(r'<!-- Category \d+:', f'<!-- Category {idx}:', section)
        new_district_content += section + '\n'

# Combine all parts
new_content = before_sections + new_district_content + after_sections

# Write back
with open(r'c:\xampp\htdocs\Work\lesson.html', 'w', encoding='utf-8') as f:
    f.write(new_content)

print("Successfully reordered district sections!")
print("New order:")
print("1. อ.เมือง")
print("2. อ.บ้านลาด")
print("3. อ.ท่ายาง")
print("4. อ.บ้านแหลม")
print("5. อ.เขาย้อย")
print("6. อ.ชะอำ")
print("7. อ.แก่งกระจาน")
print("8. อ.หนองหญ้าปล้อง")
