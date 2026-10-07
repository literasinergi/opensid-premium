{{-- aaPanel ships short_open_tag = On (php.ini:198), so a literal XML
     declaration in a Blade view is read as a PHP open tag and the page dies
     with: syntax error, unexpected identifier "version"

     Quoting it as a plain string is NOT enough. Blade refuses to compile a
     raw-echo expression containing that byte pair, so the declaration
     survives verbatim into the compiled view and fails there instead.

     Splitting the string keeps the opening and closing tag bytes from ever
     being adjacent, in this file or the compiled output, so it renders
     whatever short_open_tag is set to. --}}
{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ site_url() }}</loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
    </url>

    <!-- Sitemap -->
    @foreach ($artikel as $a)
        <url>
            <loc>{{ site_url('artikel/' . buat_slug($a)) }}</loc>
            <lastmod>{{ date_format(date_create($a['tgl_upload']), 'Y-m-d') }}</lastmod>
            <priority>0.5</priority>
            <changefreq>weekly</changefreq>
        </url>
    @endforeach

</urlset>
