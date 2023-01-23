import Image from 'next/image'

export default function Post( data ){

    const post = data.post;

    return (
        <div>
            <h1>{post.title}</h1>
            <Image width="640" height="426" src={post.featuredImage.node.sourceUrl} />
            <article dangerouslySetInnerHTML={{__html: post.content}}></article>
        </div>
    )

}

export async function getStaticProps(context) {

    const res = await fetch('http://localhost/next/graphql', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            query: `
                query MyQuery2 {
                    posts {
                    nodes {
                        title
                        content
                        uri
                        date
                    }
                    }
                }
            `,
            variables: {
                nodes: context.params.uri,
                idType: 'SLUG'
            }
        })
    })

    const json = await res.json()

    return {
        props: {
            post: json.data.post,
        },
    }

}

export async function getStaticPaths() {

    const res = await fetch('http://localhost/next/graphql', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            query: `
            query MyQuery2 {
                posts {
                nodes {
                    title
                    content
                    uri
                    date
                }
                }
            }
        `})
    })

    const json = await res.json()
    const posts = json.data.posts.nodes;

    const paths = posts.map((post) => ({
        params: { title: post.title },
    }))

    return { paths, fallback: false }

}