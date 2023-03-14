<?php

namespace Alura\Solid\Model;

use Alura\Solid\Model\Pontuavel;
use Alura\Solid\Model\Assistivel;

class Curso implements Pontuavel, Assistivel
{

    public function __construct(private string $nome, private array $videos = [], private array $feedbacks = [])
    {        
    }

    public function receberFeedback(Feedback $feedback): void
    {                
        $this->feedbacks[] = $feedback;
    }

    public function adicionarVideo(Video $video)
    {
        if ($video->minutosDeDuracao() < 3) {
            throw new \DomainException('Video muito curto');
        }

        $this->videos[] = $video;
    }

    /** @return Video[] */
    public function recuperarVideos(): array
    {
        return $this->videos;
    }

    public function recuperarPontuacao(): int
    {
        return 100;
    }

    public function assistir(): void
    {
        foreach ($this->recuperarVideos() as $video) {
            $video->assistir();
        }
    }
}
