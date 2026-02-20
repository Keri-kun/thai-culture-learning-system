# PowerShell script to reorder district sections in lesson.html
$ErrorActionPreference = "Stop"

# Read the entire file
$content = Get-Content "c:\xampp\htdocs\Work\lesson.html" -Raw -Encoding UTF8

# Define markers for each district section
$markers = @{
    'mueang' = '<!-- Category 1: อำเภอเมืองเพชรบุรี -->'
    'ban_lat' = '<!-- Category 2: อำเภอบ้านลาด -->'
    'tha_yang' = '<!-- Category 3: อำเภอท่ายาง -->'
    'ban_laem' = '<!-- Category 4: อำเภอบ้านแหลม -->'
    'khao_yoi' = '<!-- Category 5: อำเภอเขาย้อย -->'
    'cha_am' = '<!-- Category 6: อำเภอชะอำ -->'
    'kaeng_krachan' = '<!-- Category 7: อำเภอแก่งกระจาน -->'
    'nong_ya_plong' = '<!-- Category 8: อำเภอหนองหญ้าปล้อง -->'
}

# Find the start of district sections (after Category 2: ของหวาน)
$startMarker = '<!-- Category 4: อำเภอบ้านแหลม -->'
$endMarker = '<!-- Section 2: Artisans Header'

# Extract sections
$startIndex = $content.IndexOf($startMarker)
$endIndex = $content.IndexOf($endMarker)

if ($startIndex -eq -1 -or $endIndex -eq -1) {
    Write-Error "Could not find section markers"
    exit 1
}

$beforeSections = $content.Substring(0, $startIndex)
$afterSections = $content.Substring($endIndex)

# Extract each district section
$sections = @{}
$districtContent = $content.Substring($startIndex, $endIndex - $startIndex)

# Split by district markers and extract
$currentDistrict = 'ban_laem'
$currentContent = ''
$lines = $districtContent -split "`r`n"

foreach ($line in $lines) {
    if ($line -match '<!-- Category \d+: อำเภอ') {
        if ($currentContent) {
            $sections[$currentDistrict] = $currentContent
        }
        # Determine which district this is
        if ($line -match 'เมืองเพชรบุรี') { $currentDistrict = 'mueang' }
        elseif ($line -match 'บ้านลาด') { $currentDistrict = 'ban_lat' }
        elseif ($line -match 'ท่ายาง') { $currentDistrict = 'tha_yang' }
        elseif ($line -match 'บ้านแหลม') { $currentDistrict = 'ban_laem' }
        elseif ($line -match 'เขาย้อย') { $currentDistrict = 'khao_yoi' }
        elseif ($line -match 'ชะอำ') { $currentDistrict = 'cha_am' }
        elseif ($line -match 'แก่งกระจาน') { $currentDistrict = 'kaeng_krachan' }
        elseif ($line -match 'หนองหญ้าปล้อง') { $currentDistrict = 'nong_ya_plong' }
        $currentContent = $line + "`r`n"
    } else {
        $currentContent += $line + "`r`n"
    }
}
if ($currentContent) {
    $sections[$currentDistrict] = $currentContent
}

# New order with updated category numbers
$newOrder = @('mueang', 'ban_lat', 'tha_yang', 'ban_laem', 'khao_yoi', 'cha_am', 'kaeng_krachan', 'nong_ya_plong')
$categoryNum = 1

# Rebuild content in new order
$newDistrictContent = ''
foreach ($district in $newOrder) {
    $sectionContent = $sections[$district]
    # Update category number
    $sectionContent = $sectionContent -replace '<!-- Category \d+:', "<!-- Category $categoryNum:"
    $newDistrictContent += $sectionContent
    $categoryNum++
}

# Combine all parts
$newContent = $beforeSections + $newDistrictContent + $afterSections

# Write back
$newContent | Out-File "c:\xampp\htdocs\Work\lesson.html" -Encoding UTF8 -NoNewline

Write-Host "✅ Successfully reordered district sections!" -ForegroundColor Green
Write-Host "New order: เมือง → บ้านลาด → ท่ายาง → บ้านแหลม → เขาย้อย → ชะอำ → แก่งกระจาน → หนองหญ้าปล้อง" -ForegroundColor Cyan
