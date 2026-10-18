import urllib.request
from bs4 import BeautifulSoup
import json
import ssl

def check_seo(url):
    ctx = ssl.create_default_context()
    ctx.check_hostname = False
    ctx.verify_mode = ssl.CERT_NONE
    
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    try:
        html = urllib.request.urlopen(req, context=ctx).read().decode('utf-8')
    except Exception as e:
        print(f"Error fetching URL: {e}")
        return
        
    soup = BeautifulSoup(html, 'html.parser')
    
    print("=== SEO AUDIT REPORT ===")
    print(f"URL: {url}\\n")
    
    # 1. Title
    title = soup.title.string if soup.title else None
    print(f"Title: {title}")
    
    # 2. Meta Description
    meta_desc = soup.find('meta', attrs={'name': 'description'})
    print(f"Meta Description: {meta_desc['content'] if meta_desc else 'MISSING'}")
    
    # 3. Canonical
    canonical = soup.find('link', rel='canonical')
    print(f"Canonical URL: {canonical['href'] if canonical else 'MISSING'}")
    
    # 4. Open Graph Tags
    og_title = soup.find('meta', property='og:title')
    og_image = soup.find('meta', property='og:image')
    print(f"OG Title: {og_title['content'] if og_title else 'MISSING'}")
    print(f"OG Image: {og_image['content'] if og_image else 'MISSING'}")
    
    # 5. H1 Tag (Should be exactly 1)
    h1_tags = soup.find_all('h1')
    print(f"\\nNumber of H1 tags: {len(h1_tags)}")
    for i, h1 in enumerate(h1_tags):
        print(f"  H1[{i+1}]: {h1.get_text(strip=True)}")
        
    # 6. H2 Tags
    h2_tags = soup.find_all('h2')
    print(f"\\nNumber of H2 tags: {len(h2_tags)}")
    for i, h2 in enumerate(h2_tags):
        print(f"  H2[{i+1}]: {h2.get_text(strip=True)}")
        
    # 7. Images without alt text
    images = soup.find_all('img')
    missing_alt = [img['src'] for img in images if not img.get('alt')]
    print(f"\\nImages total: {len(images)}")
    print(f"Images missing alt text: {len(missing_alt)}")
    if missing_alt:
        print("  Sample missing alt:", missing_alt[:3])
        
    # 8. Schema Markup (JSON-LD)
    schemas = soup.find_all('script', type='application/ld+json')
    print(f"\\nJSON-LD Schemas found: {len(schemas)}")
    has_service_schema = False
    for s in schemas:
        try:
            data = json.loads(s.string)
            schema_type = data.get('@type')
            if schema_type == 'Service':
                has_service_schema = True
                print("  Service Schema FOUND!")
                print(f"    Name: {data.get('name')}")
                print(f"    Provider: {data.get('provider', {}).get('name')}")
        except:
            pass
            
    if not has_service_schema:
         print("  Warning: Service Schema not found!")

if __name__ == "__main__":
    check_seo("https://teamdevdesign.net/services/thiet-ke-website-doanh-nghiep")
