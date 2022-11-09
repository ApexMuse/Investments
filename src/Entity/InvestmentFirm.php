<?php

namespace App\Entity;

use App\Repository\InvestmentFirmRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvestmentFirmRepository::class)]
class InvestmentFirm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column]
    private DateTimeImmutable $created_at;

    #[ORM\Column]
    private ?DateTime $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'investment_firm', targetEntity: Account::class)]
    private Collection $accounts;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
        $this->accounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts->add($account);
            $account->setInvestmentFirm($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): self
    {
        // set the owning side to null (unless already changed)
        if ($this->accounts->removeElement($account) && $account->getInvestmentFirm() === $this) {
            $account->setInvestmentFirm(null);
        }

        return $this;
    }
}
