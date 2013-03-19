###
# Compass
###

# Susy grids in Compass
require 'susy'

# Change Compass configuration
# compass_config do |config|
#   config.output_style = :compact
# end

###
# Haml
###

# CodeRay syntax highlighting in Haml
# First: gem install haml-coderay
# require 'haml-coderay'

# CoffeeScript filters in Haml
# First: gem install coffee-filter
# require 'coffee-filter'

# Automatic image dimensions on image_tag helper
# activate :automatic_image_sizes

###
# Page command
###

# Per-page layout changes:
#
# With no layout
# page "/path/to/file.html", :layout => false
#
# With alternative layout
# page "/path/to/file.html", :layout => :otherlayout
#
# A path which all have the same layout
# with_layout :admin do
#   page "/admin/*"
# end

# Proxy (fake) files
# page "/this-page-has-no-template.html", :proxy => "/template-file.html" do
#   @which_fake_page = "Rendering a fake page with a variable"
# end

###
# Helpers
###

# Methods defined in the helpers block are available in templates
helpers do
  # Calculate the years for a copyright
  def copyright_years(start_year)
    end_year = Date.today.year
    if start_year == end_year
      start_year.to_s
    else
      start_year.to_s + '-' + end_year.to_s
    end
  end

  # Holder.js image placeholder helper
  def img_holder(opts = {})
    return "Missing Image Dimension(s)" unless opts[:width] && opts[:height]
    return "Invalid Image Dimension(s)" unless opts[:width].to_s =~ /^\d+$/ && opts[:height].to_s =~ /^\d+$/

    img  = "<img data-src=\"holder.js/#{opts[:width]}x#{opts[:height]}/auto"
    img << "/#{opts[:bgcolor]}:#{opts[:fgcolor]}" if opts[:fgcolor] && opts[:bgcolor]
    img << "/text:#{opts[:text].gsub(/'/,"\'")}" if opts[:text]
    img << "\" width=\"#{opts[:width]}\" height=\"#{opts[:height]}\">"

    img
  end

end

activate :directory_indexes

configure :build do
  activate :minify_css
  activate :minify_javascript
  activate :relative_assets
  require "rack/google_analytics"
  use Rack::GoogleAnalytics, :web_property_id => "UA-39244800-1"
end


# Twitter API junk
require 'twitter'

Twitter.configure do |config|
  config.consumer_key = "ROHfrMOlkP6YnWco0oQ"
  config.consumer_secret = "1nCJC9T7hTfxMEAOIeBp7gIEmgHS96SlAVV3RHs0"
  config.oauth_token = "BUDMKo7KGFUeJf9sn2rkHhWmjvY72glFVeUCKgfmY"
  config.oauth_token_secret = "4egvyVZVfdsWAcflvZ4xsLMJh8KI8uul6icUzTkBU"
end
