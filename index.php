<?php get_header(); ?>

<?php if ( is_home() && ! is_paged() ) : ?>
	<section class="hero">
		<div class="container">
			<h1>LASU Alumni Association</h1>
			<p>Connecting graduates of Lagos State University worldwide. For Truth and Service.</p>
			<a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="btn">Join Us</a>
			<a href="<?php echo esc_url( home_url( '/events' ) ); ?>" class="btn btn-secondary">Upcoming Events</a>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="section-title">What We Offer</h2>
			<div class="cards">
				<div class="card">
					<h3>Networking</h3>
					<p>Connect with fellow alumni across industries and locations.</p>
				</div>
				<div class="card">
					<h3>Events & Reunions</h3>
					<p>Stay informed about homecoming, chapter meetings, and professional events.</p>
				</div>
				<div class="card">
					<h3>Give Back</h3>
					<p>Support current students through mentorship, donations, and scholarships.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section bg-light">
		<div class="container">
			<h2 class="section-title">Latest News</h2>
			<div class="cards">
				<?php
				$news_query = new WP_Query( array( 'posts_per_page' => 3, 'post_status' => 'publish' ) );
				if ( $news_query->have_posts() ) :
					while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
						<div class="card">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
							<small><?php the_date(); ?></small>
						</div>
					<?php endwhile;
					wp_reset_postdata();
				else : ?>
					<div class="card"><p>No recent news. Add posts to see them here.</p></div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="section-title">Upcoming Events</h2>
			<div class="cards">
				<div class="card">
					<h3>June Networking Mixer</h3>
					<p>Lagos • 15 June • 6:00 PM</p>
				</div>
				<div class="card">
					<h3>Career Development Workshop</h3>
					<p>LASU Main Campus • 20 July</p>
				</div>
				<div class="card">
					<h3>Diaspora Alumni Virtual Meetup</h3>
					<p>Online • 24 August</p>
				</div>
			</div>
			<p style="text-align:center;margin-top:1.5rem;"><a href="<?php echo esc_url( home_url( '/events' ) ); ?>" class="btn">View All Events</a></p>
		</div>
	</section>

	<section class="section bg-light">
		<div class="container">
			<h2 class="section-title">Membership Benefits</h2>
			<div class="cards">
				<div class="card">
					<h3>Exclusive Network</h3>
					<p>Access a global community of LASU alumni.</p>
				</div>
				<div class="card">
					<h3>Event Discounts</h3>
					<p>Enjoy discounts on events and programs.</p>
				</div>
				<div class="card">
					<h3>Career Resources</h3>
					<p>Job boards, mentorship, and career tools.</p>
				</div>
				<div class="card">
					<h3>Lifelong Connection</h3>
					<p>Stay connected to LASU and fellow graduates.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="section-title">Alumni Spotlight</h2>
			<div class="cards">
				<div class="card">
					<p>“LASU shaped my future. Being part of the alumni network has opened doors I never imagined.”</p>
					<p><strong>— Adewale Johnson, Class of 2008</strong></p>
				</div>
				<div class="card">
					<p>“Giving back to LASU is more than a duty—it’s a privilege. Together, we can do more.”</p>
					<p><strong>— Funke Adebayo, Class of 2012</strong></p>
				</div>
				<div class="card">
					<p>“The relationships and opportunities I’ve gained through the alumni association are invaluable.”</p>
					<p><strong>— Olumide Okoro, Class of 2005</strong></p>
				</div>
			</div>
		</div>
	</section>

	<section class="section bg-light">
		<div class="container">
			<h2 class="section-title">Get Involved</h2>
			<p style="text-align:center;max-width:600px;margin:0 auto 1.5rem;">There are many ways to get involved and make a difference. Be a part of our growing community.</p>
			<div style="text-align:center;">
				<a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="btn">Join Now</a>
				<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-secondary">Contact Us</a>
			</div>
		</div>
	</section>
<?php else : ?>
	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-meta"><?php the_date(); ?></div>
						<div class="post-excerpt"><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<p>No posts found.</p>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
